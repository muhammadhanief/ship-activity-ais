<?php

namespace App\Livewire\MasukKeluar;

use App\Models\evaluasiA1;
use Livewire\Component;

class Chart341 extends Component
{
    public $selectedKapal = [];
    public $selectedPendekatan = [];
    public $selectedPelabuhan = [];
    public $selectAllPelabuhan = true;

    public function mount()
    {
        $this->selectedKapal = array_values(evaluasiA1::pluck('Kapal')->unique()->toArray());
        $this->selectedPendekatan = array_values(evaluasiA1::pluck('Pendekatan')->unique()->toArray());
        $this->selectedPelabuhan = array_values(evaluasiA1::pluck('Pelabuhan')->unique()->toArray());
        // $this->dispatch341();
    }

    public function updatedSelectedKapal()
    {
        $this->dispatch341();
    }

    public function updatedSelectedPendekatan()
    {
        $this->dispatch341();
    }

    public function updatedSelectedPelabuhan()
    {
        $this->dispatch341();
    }

    public function updatedSelectAllPelabuhan()
    {
        if ($this->selectAllPelabuhan) {
            $this->selectedPelabuhan = array_values(evaluasiA1::pluck('Pelabuhan')->unique()->toArray());
        } else {
            $this->selectedPelabuhan = [];
        }
    }

    public function getChartData()
    {
        $query = EvaluasiA1::selectRaw('Bulan, SUM(Data_BPS) AS Data_BPS, SUM(Prediksi) AS Prediksi, SUM(Selisih) AS Selisih')
            ->when(!empty($this->selectedKapal), function ($query) {
                return $query->whereIn('Kapal', $this->selectedKapal);
            })
            ->when(!empty($this->selectedPendekatan), function ($query) {
                return $query->whereIn('Pendekatan', $this->selectedPendekatan);
            })
            ->when(!empty($this->selectedPelabuhan), function ($query) {
                return $query->whereIn('Pelabuhan', $this->selectedPelabuhan);
            })
            ->groupBy('Bulan')
            ->orderByRaw("FIELD(Bulan, 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec')")
            ->get();

        $categories = [];
        $dataBPS = [];
        $prediksi = [];
        $selisih = [];

        foreach ($query as $item) {
            $categories[] = $item->Bulan;
            $dataBPS[] = (float) $item->Data_BPS;
            $prediksi[] = (float) $item->Prediksi;
            $selisih[] = (float) $item->Selisih;
        }

        return [
            'categories' => $categories,
            'series' => [
                ['name' => 'Data BPS', 'type' => 'line', 'data' => $dataBPS],
                ['name' => 'Prediksi', 'type' => 'line', 'data' => $prediksi],
                ['name' => 'Selisih', 'type' => 'column', 'data' => $selisih],
            ],
        ];
    }


    public function dispatch341()
    {
        if (empty($this->selectedKapal) || empty($this->selectedPendekatan) || empty($this->selectedPelabuhan)) {
            $chartData = [
                'categories' => [],
                'series' => [
                    ['name' => 'Kapal Masuk', 'data' => []],
                    ['name' => 'Kapal Keluar', 'data' => []],
                    ['name' => 'Kapal Gatau', 'data' => []],
                ],
            ];
            // dd($chartData);
            $this->dispatch('chart341Update', $chartData);
            return;
        }
        $chartData = $this->getChartData();
        $this->dispatch('chart341Update', $chartData);
    }

    public function dd()
    {
        dd($this->all());
    }


    public function render()
    {
        $kapalOptions = evaluasiA1::pluck('Kapal')->unique()->toArray();
        $pendekatanOptions = evaluasiA1::pluck('Pendekatan')->unique()->toArray();
        $pelabuhanOptions = evaluasiA1::pluck('Pelabuhan')->unique()->toArray();
        $this->dispatch341();
        return view('livewire.masuk-keluar.chart341', compact('kapalOptions', 'pendekatanOptions', 'pelabuhanOptions'));
    }
}
