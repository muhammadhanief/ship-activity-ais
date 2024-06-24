<?php

namespace App\Livewire\MasukKeluar;

use Livewire\Component;
use App\Models\masukKeluarIndoPerTipeKapal;
use Illuminate\Support\Facades\DB;

class Chart321 extends Component
{
    public $selectedKapal = [];
    public $selectedPendekatan = [];
    public $selectedPelabuhan = [];
    public $selectAllPelabuhan = true;

    public function mount()
    {
        $this->selectedKapal = array_values(masukKeluarIndoPerTipeKapal::pluck('Kapal')->unique()->toArray());
        $this->selectedPendekatan = array_values(masukKeluarIndoPerTipeKapal::pluck('Pendekatan')->unique()->toArray());
        $this->selectedPelabuhan = array_values(masukKeluarIndoPerTipeKapal::pluck('Pelabuhan')->unique()->toArray());
        // $this->dispatch321();
    }

    public function updatedSelectedKapal()
    {
        $this->dispatch321();
    }

    public function updatedSelectedPendekatan()
    {
        $this->dispatch321();
    }

    public function updatedSelectedPelabuhan()
    {
        $this->dispatch321();
    }

    public function updatedSelectAllPelabuhan()
    {
        if ($this->selectAllPelabuhan) {
            $this->selectedPelabuhan = array_values(masukKeluarIndoPerTipeKapal::pluck('Pelabuhan')->unique()->toArray());
        } else {
            $this->selectedPelabuhan = [];
        }
    }

    public function dd()
    {
        dd($this->all());
    }

    public function dispatch321()
    {
        if (empty($this->selectedKapal) || empty($this->selectedPendekatan) || empty($this->selectedPelabuhan)) {
            $chartData = [
                'categories' => [],
                'series' => [
                    ['name' => 'Kapal Masuk', 'data' => []],
                    ['name' => 'Kapal Keluar', 'data' => []],
                ],
            ];
            // dd($chartData);
            $this->dispatch('chart321Update', ['chartData' => $chartData]);
            return;
        }

        $chartData = $this->getChartData();
        // dd($chartData);
        $this->dispatch('chart321Update', $chartData);
    }

    public function getChartData()
    {
        $query = masukKeluarIndoPerTipeKapal::query()
            ->select(
                'Tipe Kapal',
                DB::raw('SUM(Masuk) as total_masuk'),
                DB::raw('SUM(Keluar) as total_keluar')
            )
            ->when($this->selectedKapal, function ($query) {
                return $query->whereIn('Kapal', $this->selectedKapal);
            })
            ->when($this->selectedPendekatan, function ($query) {
                return $query->whereIn('Pendekatan', $this->selectedPendekatan);
            })
            ->when($this->selectedPelabuhan, function ($query) {
                return $query->whereIn('Pelabuhan', $this->selectedPelabuhan);
            })
            ->groupBy('Tipe Kapal')
            ->orderByDesc('total_masuk')
            ->get();

        $categories = $query->pluck('Tipe Kapal')->toArray();
        $dataMasuk = $query->pluck('total_masuk')->toArray();
        $dataKeluar = $query->pluck('total_keluar')->toArray();

        return [
            'categories' => $categories,
            'series' => [
                ['name' => 'Kapal Masuk', 'data' => $dataMasuk],
                ['name' => 'Kapal Keluar', 'data' => $dataKeluar]
            ]
        ];
    }


    public function render()
    {
        $kapalOptions = masukKeluarIndoPerTipeKapal::pluck('Kapal')->unique();
        $pendekatanOptions = masukKeluarIndoPerTipeKapal::pluck('Pendekatan')->unique();
        $pelabuhanOptions = masukKeluarIndoPerTipeKapal::pluck('Pelabuhan')->unique();
        $this->dispatch321();
        return view('livewire.masuk-keluar.chart321', compact('kapalOptions', 'pendekatanOptions', 'pelabuhanOptions'));
    }
}
