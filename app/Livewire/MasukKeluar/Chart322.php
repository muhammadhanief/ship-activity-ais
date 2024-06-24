<?php

namespace App\Livewire\MasukKeluar;

use App\Models\masukKeluarIndoPerTipeKapal;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart322 extends Component
{
    public $selectedPendekatan = [];
    public $selectedKapal = [];
    public $selectedPelabuhan = [];
    public $selectAllPelabuhan = true;
    public $selectedMasukOrKeluar;

    public function selectMasukOrKeluar($option)
    {
        $this->selectedMasukOrKeluar = $option;
        // $this->updatedSelectedMasukOrKeluar();
    }

    public function updatedSelectAllPelabuhan()
    {
        if ($this->selectAllPelabuhan) {
            $this->selectedPelabuhan = array_values(masukKeluarIndoPerTipeKapal::pluck('Pelabuhan')->unique()->toArray());
        } else {
            $this->selectedPelabuhan = [];
        }
    }

    public function mount()
    {
        $this->selectedPendekatan = array_values(masukKeluarIndoPerTipeKapal::pluck('Pendekatan')->unique()->toArray());
        $this->selectedKapal = array_values(masukKeluarIndoPerTipeKapal::pluck('Kapal')->unique()->toArray());
        $this->selectedPelabuhan = array_values(masukKeluarIndoPerTipeKapal::pluck('Pelabuhan')->unique()->toArray());
        $this->selectedMasukOrKeluar = 'Masuk';
    }

    public function updatedSelectedPendekatan()
    {
        $this->dispatch322();
    }

    public function updatedSelectedKapal()
    {
        $this->dispatch322();
    }

    public function updatedSelectedPelabuhan()
    {
        $this->selectAllPelabuhan = count($this->selectedPelabuhan) === count(masukKeluarIndoPerTipeKapal::pluck('Pelabuhan')->unique()->toArray());
        $this->dispatch322();
    }


    public function updatedSelectedMasukOrKeluar()
    {
        // dd('masuk kok keluar');
        $this->dispatch322();
    }

    public function dispatch322()
    {
        if (empty($this->selectedPendekatan) || empty($this->selectedKapal) || empty($this->selectedPelabuhan)) {
            $chartData = [];
            $this->dispatch('chart322Update', ['chartData' => $chartData]);
            return;
        }

        $chartData = $this->getChartData();
        $this->dispatch('chart322Update', ['chartData' => $chartData]);
    }

    public function getChartData()
    {
        // Query untuk mengambil data dari tabel berdasarkan kondisi yang dipilih
        $query = masukKeluarIndoPerTipeKapal::query()
            ->selectRaw('`Tipe Kapal` AS `tipe_kapal`')
            ->selectRaw('SUM(Masuk) AS total_masuk')
            ->selectRaw('SUM(Keluar) AS total_keluar')
            ->when($this->selectedKapal, function ($query) {
                return $query->whereIn('Kapal', $this->selectedKapal);
            })
            ->when($this->selectedPendekatan, function ($query) {
                return $query->whereIn('Pendekatan', $this->selectedPendekatan);
            })
            ->when($this->selectedPelabuhan, function ($query) {
                return $query->whereIn('Pelabuhan', $this->selectedPelabuhan);
            })
            ->groupBy('tipe_kapal');

        // Ambil data query
        $results = $query->get();

        // Hitung total masuk dan keluar
        $total_masuk = $results->sum('total_masuk');
        $total_keluar = $results->sum('total_keluar');

        // Tentukan total berdasarkan pilihan masuk atau keluar
        $total = $this->selectedMasukOrKeluar === 'Masuk' ? $total_masuk : $total_keluar;

        // Ambil data query dan transformasikan sesuai dengan kebutuhan chart
        $chartData = $results->map(function ($item) use ($total) {
            $y_value = $this->selectedMasukOrKeluar === 'Masuk' ? $item->total_masuk : $item->total_keluar;
            $percentage = ($total > 0) ? ($y_value / $total) * 100 : 0;

            return [
                'name' => $item->tipe_kapal,
                'y' => round($percentage, 2), // Bulatkan persentase ke 2 desimal
            ];
        });

        // Pastikan total persentase tidak melebihi 100%
        $total_percentage = $chartData->sum('y');
        if ($total_percentage > 100) {
            $chartData = $chartData->map(function ($data) use ($total_percentage) {
                $data['y'] = ($data['y'] / $total_percentage) * 100;
                return $data;
            });
        }

        return $chartData->toArray();
    }

    public function dd()
    {
        dd($this->all());
    }

    public function render()
    {
        $pendekatanOptions = masukKeluarIndoPerTipeKapal::pluck('Pendekatan')->unique()->toArray();
        $kapalOptions = masukKeluarIndoPerTipeKapal::pluck('Kapal')->unique()->toArray();
        $pelabuhanOptions = masukKeluarIndoPerTipeKapal::pluck('Pelabuhan')->unique()->toArray();
        $masukOrKeluarOptions = ['Masuk', 'Keluar'];
        $this->dispatch322();

        return view('livewire.masuk-keluar.chart322', compact('pendekatanOptions', 'kapalOptions', 'pelabuhanOptions', 'masukOrKeluarOptions'));
    }
}
