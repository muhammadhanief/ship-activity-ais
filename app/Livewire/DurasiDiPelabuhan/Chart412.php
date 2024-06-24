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
            $query = MeanMedianDurasiIndoPerNegaraKapal::selectRaw('Negara_Kapal, SUM(Rata_Rata_Durasi) AS total_rataRataDurasi, SUM(Median_Durasi) AS total_medianDurasi')
                ->whereIn('Pendekatan', $this->selectedPendekatan)
                ->whereIn('Pelabuhan', $this->selectedPelabuhan)
                ->whereIn('Satuan', $this->selectedSatuan)
                ->groupBy('Negara_Kapal')
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
                $formattedData['categories'][] = $item->Negara_Kapal;
                $formattedData['series'][0]['data'][] = (float) $item->total_medianDurasi;
                $formattedData['series'][1]['data'][] = (float) $item->total_rataRataDurasi;
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
