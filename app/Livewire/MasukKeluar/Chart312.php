<?php

namespace App\Livewire\MasukKeluar;

use App\Models\masukKeluarIndoPerBulan;
use Livewire\Component;

class Chart312 extends Component
{
    public $selectedPendekatan = [];
    public $selectedBulan = [];
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
            $this->selectedPelabuhan = array_values(masukKeluarIndoPerBulan::pluck('Pelabuhan')->unique()->toArray());
        } else {
            $this->selectedPelabuhan = [];
        }
    }

    public function mount()
    {
        $this->selectedPendekatan = array_values(masukKeluarIndoPerBulan::pluck('Pendekatan')->unique()->toArray());
        $this->selectedBulan = array_values(masukKeluarIndoPerBulan::pluck('Bulan')->unique()->toArray());
        $this->selectedPelabuhan = array_values(masukKeluarIndoPerBulan::pluck('Pelabuhan')->unique()->toArray());
        $this->selectedMasukOrKeluar = 'Masuk';
    }

    public function updatedSelectedPendekatan()
    {
        $this->dispatch312();
    }

    public function updatedSelectedBulan()
    {
        $this->dispatch312();
    }

    public function updatedSelectedPelabuhan()
    {
        $this->selectAllPelabuhan = count($this->selectedPelabuhan) === count(masukKeluarIndoPerBulan::pluck('Pelabuhan')->unique()->toArray());
        $this->dispatch312();
    }

    public function updatedSelectedMasukOrKeluar()
    {
        // dd('masuk kok keluar');
        $this->dispatch312();
    }

    public function dispatch312()
    {
        if (empty($this->selectedPendekatan) || empty($this->selectedBulan) || empty($this->selectedPelabuhan)) {
            $chartData = [];
            $this->dispatch('chart312Update', ['chartData' => $chartData]);
            return;
        }

        $chartData = $this->getChartData();
        $this->dispatch('chart312Update', ['chartData' => $chartData]);
    }

    public function getChartData()
    {
        // Query untuk mengambil data dari tabel berdasarkan kondisi yang dipilih
        $query = masukKeluarIndoPerBulan::query()
            ->selectRaw("
            Kapal AS 'name',
            SUM(Masuk) AS 'y_masuk',
            SUM(Keluar) AS 'y_keluar'
        ")
            ->whereIn('Pendekatan', $this->selectedPendekatan)
            ->whereIn('Bulan', $this->selectedBulan)
            ->whereIn('Pelabuhan', $this->selectedPelabuhan)
            ->groupBy('Kapal')
            ->get();

        // Menghitung total Masuk dan Keluar
        $total_masuk = $query->sum('y_masuk');
        $total_keluar = $query->sum('y_keluar');

        // Menghitung total berdasarkan pilihan Masuk atau Keluar
        $total = $this->selectedMasukOrKeluar === 'Masuk' ? $total_masuk : $total_keluar;

        // Transformasi data sesuai dengan kebutuhan chart
        $chartData = $query->map(function ($item) use ($total) {
            $y_value = $this->selectedMasukOrKeluar === 'Masuk' ? $item->y_masuk : $item->y_keluar;
            $percentage = ($total > 0) ? ($y_value / $total) * 100 : 0;

            return [
                'name' => $item->name,
                'y' => $percentage,
            ];
        });

        return $chartData->toArray();
    }



    public function dd()
    {
        dd($this->all());
    }


    public function render()
    {
        $pendekatanOptions = array_values(masukKeluarIndoPerBulan::pluck('Pendekatan')->unique()->toArray()); // Ubah sesuai nama kolom model Anda
        $bulanOptions = array_values(masukKeluarIndoPerBulan::pluck('Bulan')->unique()->toArray()); // Ubah sesuai nama kolom model Anda
        $pelabuhanOptions = array_values(masukKeluarIndoPerBulan::pluck('Pelabuhan')->unique()->toArray()); // Ubah sesuai nama kolom model Anda
        $masukOrKeluarOptions = ['Masuk', 'Keluar']; // Ubah sesuai nama kolom model Anda
        $this->dispatch312();
        // dd($pendekatanOptions, $bulanOptions, $pelabuhanOptions, $masukOrKeluarOptions);
        return view('livewire.masuk-keluar.chart312', compact('pendekatanOptions', 'bulanOptions', 'pelabuhanOptions', 'masukOrKeluarOptions'));
    }
}
