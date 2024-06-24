<?php

namespace App\Livewire\DurasiDiPelabuhan;

use App\Models\meanMedianDurasiIndoPerNegaraKapal;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart412 extends Component
{
    public $selectedPendekatan = [];
    public $selectedSatuan = [];
    public $selectedPelabuhan = [];
    public $selectAllPelabuhan = true;

    public function mount()
    {
        $this->selectedPendekatan = array_values(meanMedianDurasiIndoPerNegaraKapal::pluck('Pendekatan')->unique()->toArray());
        $this->selectedSatuan = array_values(meanMedianDurasiIndoPerNegaraKapal::pluck('Satuan')->unique()->toArray());
        $this->selectedPelabuhan = array_values(meanMedianDurasiIndoPerNegaraKapal::pluck('Pelabuhan')->unique()->toArray());
    }

    public function updatedSelectedPendekatan()
    {
        $this->dispatch412();
    }

    public function updatedSelectedSatuan()
    {
        $this->dispatch412();
    }

    public function updatedSelectedPelabuhan()
    {
        $this->dispatch412();
    }

    public function updatedSelectAllPelabuhan()
    {
        if ($this->selectAllPelabuhan) {
            $this->selectedPelabuhan = array_values(meanMedianDurasiIndoPerNegaraKapal::pluck('Pelabuhan')->unique()->toArray());
        } else {
            $this->selectedPelabuhan = [];
        }
    }

    public function dispatch412()
    {
        if (empty($this->selectedPendekatan) || empty($this->selectedPelabuhan) || empty($this->selectedSatuan)) {
            $formattedData = [
                'categories' => [],
                'series' => [
                    ['name' => 'Median Durasi', 'data' => []],
                    ['name' => 'Rata-rata Durasi', 'data' => []]
                ]
            ];
        } else {
            $query = MeanMedianDurasiIndoPerNegaraKapal::selectRaw('Negara_Kapal, 
            GROUP_CONCAT(Median_Durasi ORDER BY Median_Durasi) AS all_medianDurasi, 
            COUNT(Median_Durasi) AS count_medianDurasi,
            SUM(Median_Durasi) AS total_medianDurasi,
            AVG(Rata_Rata_Durasi) AS avg_rataRataDurasi')
                ->whereIn('Pendekatan', $this->selectedPendekatan)
                ->whereIn('Pelabuhan', $this->selectedPelabuhan)
                ->whereIn('Satuan', $this->selectedSatuan)
                ->groupBy('Negara_Kapal')
                ->orderByDesc('avg_rataRataDurasi')
                ->limit(10)
                ->get();

            $formattedData = [
                'categories' => [],
                'series' => [
                    ['name' => 'Median Durasi', 'data' => []],
                    ['name' => 'Rata-rata Durasi', 'data' => []]
                ]
            ];

            foreach ($query as $item) {
                // Menghitung median dari all_medianDurasi
                $medianData = explode(',', $item->all_medianDurasi);
                $count = $item->count_medianDurasi;
                $median = $count % 2 == 0 ? ($medianData[$count / 2 - 1] + $medianData[$count / 2]) / 2 : $medianData[floor($count / 2)];

                $formattedData['categories'][] = $item->Negara_Kapal;
                $formattedData['series'][0]['data'][] = (float) $median;
                $formattedData['series'][1]['data'][] = (float) $item->avg_rataRataDurasi;
            }
        }

        $this->dispatch('chart412Update', $formattedData);
    }


    public function render()
    {
        $pendekatanOptions = meanMedianDurasiIndoPerNegaraKapal::pluck('Pendekatan')->unique();
        $satuanOptions = meanMedianDurasiIndoPerNegaraKapal::pluck('Satuan')->unique();
        $pelabuhanOptions = meanMedianDurasiIndoPerNegaraKapal::pluck('Pelabuhan')->unique();
        $this->dispatch412();
        return view('livewire.durasi-di-pelabuhan.chart412', [
            'pendekatanOptions' => $pendekatanOptions,
            'satuanOptions' => $satuanOptions,
            'pelabuhanOptions' => $pelabuhanOptions
        ]);
    }
}
