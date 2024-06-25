<?php

namespace App\Livewire\DurasiDiPelabuhan;

use Livewire\Component;
use App\Models\meanMedianDurasiIndoPerBulan;

class Chart411 extends Component
{
    public $selectedPendekatan = [];
    public $selectedKapal = [];
    public $selectedSatuan = [];
    public $selectedPelabuhan = [];
    public $selectAllPelabuhan = true;

    public function mount()
    {
        $this->selectedPendekatan = array_values(meanMedianDurasiIndoPerBulan::pluck('Pendekatan')->unique()->toArray());
        $this->selectedKapal = array_values(meanMedianDurasiIndoPerBulan::pluck('Kapal')->unique()->toArray());
        $this->selectedSatuan = array_values(meanMedianDurasiIndoPerBulan::pluck('Satuan')->unique()->toArray());
        $this->selectedPelabuhan = array_values(meanMedianDurasiIndoPerBulan::pluck('Pelabuhan')->unique()->toArray());
    }

    public function updatedSelectedPendekatan()
    {
        $this->dispatch411();
    }

    public function updatedSelectedKapal()
    {
        $this->dispatch411();
    }

    public function updatedSelectedSatuan()
    {
        $this->dispatch411();
    }

    public function updatedSelectedPelabuhan()
    {
        $this->dispatch411();
    }

    public function updatedSelectAllPelabuhan()
    {
        if ($this->selectAllPelabuhan) {
            $this->selectedPelabuhan = array_values(meanMedianDurasiIndoPerBulan::pluck('Pelabuhan')->unique()->toArray());
        } else {
            $this->selectedPelabuhan = [];
        }
    }

    public function getChartData()
    {
        // Implementasikan query untuk mendapatkan data dari tabel MeanMedianDurasiIndoPerBulan
        $data = MeanMedianDurasiIndoPerBulan::query();

        // Filter berdasarkan selectedPendekatan
        if (!empty($this->selectedPendekatan)) {
            $data->whereIn('Pendekatan', $this->selectedPendekatan);
        }

        // Filter berdasarkan selectedKapal
        if (!empty($this->selectedKapal)) {
            $data->whereIn('Kapal', $this->selectedKapal);
        }

        // Filter berdasarkan selectedSatuan
        if (!empty($this->selectedSatuan)) {
            $data->whereIn('Satuan', $this->selectedSatuan);
        }

        // Filter berdasarkan selectedPelabuhan
        if (!empty($this->selectedPelabuhan)) {
            $data->whereIn('Pelabuhan', $this->selectedPelabuhan);
        }

        // Ambil data untuk median durasi dan rata-rata durasi per bulan
        $data = $data->selectRaw('Bulan, SUM(Median_Durasi) as Sum_Median_Durasi, SUM(Rata_Rata_Durasi) as Sum_Rata_Rata_Durasi')
            ->groupBy('Bulan')
            ->get();

        // Format data untuk chart
        $chartData = [
            'categories' => $data->pluck('Bulan')->toArray(),
            'medianDurasi' => $data->pluck('Sum_Median_Durasi')->toArray(),
            'rataRataDurasi' => $data->pluck('Sum_Rata_Rata_Durasi')->toArray(),
        ];

        return $chartData;
    }

    public function dispatch411()
    {
        if (empty($this->selectedKapal) || empty($this->selectedPendekatan) || empty($this->selectedPelabuhan) || empty($this->selectedSatuan)) {
            $chartData = [
                'categories' => [],
                'medianDurasi' => [],
                'rataRataDurasi' => [],
            ];
            // dd($chartData);
            $this->dispatch('chart411Update', $chartData);
            return;
        }

        $this->dispatch('chart411Update', $this->getChartData());
    }

    public function render()
    {
        $pendekatanOptions = meanMedianDurasiIndoPerBulan::pluck('Pendekatan')->unique();
        $kapalOptions = meanMedianDurasiIndoPerBulan::pluck('Kapal')->unique();
        $satuanOptions = meanMedianDurasiIndoPerBulan::pluck('Satuan')->unique();
        $pelabuhanOptions = meanMedianDurasiIndoPerBulan::pluck('Pelabuhan')->unique();
        $this->dispatch411();
        return view('livewire.durasi-di-pelabuhan.chart411', [
            'pendekatanOptions' => $pendekatanOptions,
            'kapalOptions' => $kapalOptions,
            'satuanOptions' => $satuanOptions,
            'pelabuhanOptions' => $pelabuhanOptions,
        ]);
    }
}