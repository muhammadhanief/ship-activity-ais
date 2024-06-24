<?php

namespace App\Livewire\MasukKeluar;

use App\Models\masukKeluarIndoPerNegara;
use Livewire\Component;

class Chart331 extends Component
{
    public $selectedPendekatan = [];
    public $selectedPelabuhan = [];
    public $selectAllPelabuhan = true;

    public function mount()
    {
        $this->selectedPendekatan = array_values(masukKeluarIndoPerNegara::pluck('Pendekatan')->unique()->toArray());
        $this->selectedPelabuhan = array_values(masukKeluarIndoPerNegara::pluck('Pelabuhan')->unique()->toArray());
    }

    public function updatedSelectedPendekatan()
    {
        $this->dispatch331();
    }

    public function updatedSelectedPelabuhan()
    {
        $this->dispatch331();
    }

    public function updatedSelectAllPelabuhan()
    {
        if ($this->selectAllPelabuhan) {
            $this->selectedPelabuhan = array_values(masukKeluarIndoPerNegara::pluck('Pelabuhan')->unique()->toArray());
        } else {
            $this->selectedPelabuhan = [];
        }
    }

    public function dd()
    {
        dd($this->all());
    }

    public function dispatch331()
    {
        if (empty($this->selectedPendekatan) || empty($this->selectedPelabuhan)) {
            $formattedData = [
                'categories' => [],
                'series' => [
                    ['name' => 'Kapal Masuk', 'data' => []],
                    ['name' => 'Kapal Keluar', 'data' => []]
                ]
            ];
        } else {
            $query = MasukKeluarIndoPerNegara::selectRaw('Negara_Asal, SUM(Masuk) AS Kapal_Masuk, SUM(Keluar) AS Kapal_Keluar')
                // ->where('Negara_Asal', "!=", 'Indonesia')
                ->whereIn('Pendekatan', $this->selectedPendekatan)
                ->whereIn('Pelabuhan', $this->selectedPelabuhan)
                ->groupBy('Negara_Asal')
                ->orderByDesc('Kapal_Masuk')
                ->limit(10)
                ->get();

            $formattedData = [
                'categories' => [],
                'series' => [
                    ['name' => 'Kapal Masuk', 'data' => []],
                    ['name' => 'Kapal Keluar', 'data' => []]
                ]
            ];

            foreach ($query as $item) {
                $formattedData['categories'][] = $item->Negara_Asal;
                $formattedData['series'][0]['data'][] = (int) $item->Kapal_Masuk;
                $formattedData['series'][1]['data'][] = (int) $item->Kapal_Keluar;
            }
        }

        $this->dispatch('chart331Update', $formattedData);
    }



    public function getChartData()
    {
    }

    public function render()
    {
        $pendekatanOptions = masukKeluarIndoPerNegara::pluck('Pendekatan')->unique();
        $pelabuhanOptions = masukKeluarIndoPerNegara::pluck('Pelabuhan')->unique();
        $this->dispatch331();
        return view('livewire.masuk-keluar.chart331', compact('pendekatanOptions', 'pelabuhanOptions'));
    }
}
