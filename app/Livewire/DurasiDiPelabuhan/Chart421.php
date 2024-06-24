<?php

namespace App\Livewire\DurasiDiPelabuhan;

use App\Models\meanMedianDurasiIndoPerTipeKapal;
use Livewire\Component;

class Chart421 extends Component
{
    public $selectedPendekatan = [];
    public $selectedKapal = [];
    public $selectedSatuan = [];
    public $selectedPelabuhan = [];
    public $selectAllPelabuhan = true;

    public function mount()
    {
        $this->selectedPendekatan = array_values(meanMedianDurasiIndoPerTipeKapal::pluck('Pendekatan')->unique()->toArray());
        $this->selectedKapal = array_values(meanMedianDurasiIndoPerTipeKapal::pluck('Kapal')->unique()->toArray());
        $this->selectedSatuan = array_values(meanMedianDurasiIndoPerTipeKapal::pluck('Satuan')->unique()->toArray());
        $this->selectedPelabuhan = array_values(meanMedianDurasiIndoPerTipeKapal::pluck('Pelabuhan')->unique()->toArray());
    }

    public function updatedSelectedPendekatan()
    {
        $this->dispatch421();
    }

    public function updatedSelectedKapal()
    {
        $this->dispatch421();
    }

    public function updatedSelectedSatuan()
    {
        $this->dispatch421();
    }

    public function updatedSelectedPelabuhan()
    {
        $this->dispatch421();
    }

    public function updatedSelectAllPelabuhan()
    {
        if ($this->selectAllPelabuhan) {
            $this->selectedPelabuhan = array_values(meanMedianDurasiIndoPerTipeKapal::pluck('Pelabuhan')->unique()->toArray());
        } else {
            $this->selectedPelabuhan = [];
        }
    }

    public function dispatch421()
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
            $query = meanMedianDurasiIndoPerTipeKapal::selectRaw('Tipe_Kapal, 
                GROUP_CONCAT(Median_Durasi ORDER BY Median_Durasi) AS all_medianDurasi, 
                COUNT(Median_Durasi) AS count_medianDurasi,
                AVG(Rata_Rata_Durasi) AS avg_rataRataDurasi')
                ->whereIn('Pendekatan', $this->selectedPendekatan)
                ->whereIn('Kapal', $this->selectedKapal)
                ->whereIn('Satuan', $this->selectedSatuan)
                ->whereIn('Pelabuhan', $this->selectedPelabuhan)
                ->groupBy('Tipe_Kapal')
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

                $formattedData['categories'][] = $item->Tipe_Kapal;
                $formattedData['series'][0]['data'][] = (float) $median;
                $formattedData['series'][1]['data'][] = (float) $item->avg_rataRataDurasi;
            }

            // $this->dispatch('chart421Update', $formattedData);
        }

        $this->dispatch('chart421Update', $formattedData);
    }


    public function render()
    {
        $pendekatanOptions = meanMedianDurasiIndoPerTipeKapal::pluck('Pendekatan')->unique();
        $kapalOptions = meanMedianDurasiIndoPerTipeKapal::pluck('Kapal')->unique();
        $satuanOptions = meanMedianDurasiIndoPerTipeKapal::pluck('Satuan')->unique();
        $pelabuhanOptions = meanMedianDurasiIndoPerTipeKapal::pluck('Pelabuhan')->unique();
        $this->dispatch421();
        return view('livewire.durasi-di-pelabuhan.chart421', [
            'pendekatanOptions' => $pendekatanOptions,
            'kapalOptions' => $kapalOptions,
            'satuanOptions' => $satuanOptions,
            'pelabuhanOptions' => $pelabuhanOptions,
        ]);
    }
}
