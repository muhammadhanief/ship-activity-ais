<?php

namespace App\Livewire\KunjunganKeLuarNegeri;

use App\Models\masukKeluarLnPerBulan;

use Livewire\Component;

class Chart511 extends Component
{
    public $selectedPendekatan = [];
    public $selectedPelabuhan = [];
    public $selectAllPelabuhan = true;

    public function mount()
    {
        $this->selectedPendekatan = array_values(masukKeluarLnPerBulan::pluck('Pendekatan')->unique()->toArray());
        $this->selectedPelabuhan = array_values(masukKeluarLnPerBulan::pluck('Pelabuhan')->unique()->toArray());
    }

    public function updatedSelectedPendekatan()
    {
        $this->dispatch511();
    }

    public function updatedSelectedPelabuhan()
    {
        $this->dispatch511();
    }

    public function updatedSelectAllPelabuhan()
    {
        if ($this->selectAllPelabuhan) {
            $this->selectedPelabuhan = array_values(masukKeluarLnPerBulan::pluck('Pelabuhan')->unique()->toArray());
        } else {
            $this->selectedPelabuhan = [];
        }
    }

    public function getChartData()
    {
        $query = masukKeluarLnPerBulan::selectRaw('Bulan, SUM(Masuk) AS Masuk, SUM(Keluar) AS Keluar')
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
        $masuk = [];
        $keluar = [];

        foreach ($query as $row) {
            $categories[] = $row->Bulan;
            $masuk[] = $row->Masuk;
            $keluar[] = $row->Keluar;
        }

        return [
            'categories' => $categories,
            'series' => [
                ['name' => 'Masuk', 'type' => 'line', 'data' => $masuk],
                ['name' => 'Keluar', 'type' => 'line', 'data' => $keluar]
            ]
        ];
    }

    public function dispatch511()
    {
        if (empty($this->selectedPendekatan) || empty($this->selectedPelabuhan)) {
            $chartData = [
                'categories' => [],
                'series' => [
                    ['name' => 'Masuk', 'data' => []],
                    ['name' => 'Keluar', 'data' => []]
                ]
            ];
        } else {
            $chartData = $this->getChartData();
        }

        $this->dispatch('chart511Update', $chartData);
    }

    public function render()
    {
        $pendekatanOptions = masukKeluarLnPerBulan::pluck('Pendekatan')->unique();
        $pelabuhanOptions = masukKeluarLnPerBulan::pluck('Pelabuhan')->unique();
        $this->dispatch511();
        return view('livewire.kunjungan-ke-luar-negeri.chart511', compact('pendekatanOptions', 'pelabuhanOptions'));
    }
}
