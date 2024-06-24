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
            $query = meanMedianDurasiIndoPerTipeKapal::selectRaw('Tipe_Kapal, SUM(Rata_Rata_Durasi) AS total_rataRataDurasi, SUM(Median_Durasi) AS total_medianDurasi')
                ->whereIn('Pendekatan', $this->selectedPendekatan)
                ->whereIn('Kapal', $this->selectedKapal)
                ->whereIn('Satuan', $this->selectedSatuan)
                ->whereIn('Pelabuhan', $this->selectedPelabuhan)
                ->groupBy('Tipe_Kapal')
                ->orderByDesc('total_medianDurasi')
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
                $formattedData['categories'][] = $item->Tipe_Kapal;
                $formattedData['series'][0]['data'][] = (float) $item->total_medianDurasi;
                $formattedData['series'][1]['data'][] = (float) $item->total_rataRataDurasi;
            }
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
