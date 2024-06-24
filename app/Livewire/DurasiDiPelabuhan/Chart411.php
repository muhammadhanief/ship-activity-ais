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
        $query = MeanMedianDurasiIndoPerBulan::selectRaw('Bulan, 
        GROUP_CONCAT(Median_Durasi ORDER BY Median_Durasi) AS all_medianDurasi, 
        COUNT(Median_Durasi) AS count_medianDurasi,
        AVG(Rata_Rata_Durasi) AS avg_rataRataDurasi')
            ->when($this->selectedPendekatan, function ($query) {
                $query->whereIn('Pendekatan', $this->selectedPendekatan);
            })
            ->when($this->selectedKapal, function ($query) {
                $query->whereIn('Kapal', $this->selectedKapal);
            })
            ->when($this->selectedSatuan, function ($query) {
                $query->whereIn('Satuan', $this->selectedSatuan);
            })
            ->when($this->selectedPelabuhan, function ($query) {
                $query->whereIn('Pelabuhan', $this->selectedPelabuhan);
            })
            ->groupBy('Bulan')
            ->orderBy('Bulan')
            ->get();

        $categories = [];
        $medianDurasi = [];
        $rataRataDurasi = [];

        foreach ($query as $item) {
            // Menghitung median dari all_medianDurasi
            $medianData = explode(',', $item->all_medianDurasi);
            $count = $item->count_medianDurasi;
            $median = $count % 2 == 0 ? ($medianData[$count / 2 - 1] + $medianData[$count / 2]) / 2 : $medianData[floor($count / 2)];

            $categories[] = $item->Bulan;
            $medianDurasi[] = (float) $median;
            $rataRataDurasi[] = (float) $item->avg_rataRataDurasi;
        }

        $chartData = [
            'categories' => $categories,
            'medianDurasi' => $medianDurasi,
            'rataRataDurasi' => $rataRataDurasi,
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
