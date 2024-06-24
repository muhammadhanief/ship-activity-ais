<?php

namespace App\Livewire\MasukKeluar;

use App\Models\masukKeluarIndoPerBulan;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Chart311 extends Component
{
    public $selectedKapal = [];
    public $selectedPendekatan = [];
    public $selectedPelabuhan = [];
    public $selectAllPelabuhan = true;

    public function mount()
    {
        $this->selectedKapal = array_values(masukKeluarIndoPerBulan::pluck('Kapal')->unique()->toArray());
        $this->selectedPendekatan = array_values(masukKeluarIndoPerBulan::pluck('Pendekatan')->unique()->toArray());
        $this->selectedPelabuhan = array_values(masukKeluarIndoPerBulan::pluck('Pelabuhan')->unique()->toArray());
    }



    public function updatedSelectedKapal()
    {
        $this->testDispatch();
    }

    public function updatedSelectedPendekatan()
    {
        $this->testDispatch();
    }

    public function updatedSelectAllPelabuhan()
    {
        if ($this->selectAllPelabuhan) {
            $this->selectedPelabuhan = array_values(masukKeluarIndoPerBulan::pluck('Pelabuhan')->unique()->toArray());
        } else {
            $this->selectedPelabuhan = [];
        }
    }

    public function updatedSelectedPelabuhan()
    {
        $this->selectAllPelabuhan = count($this->selectedPelabuhan) === count(masukKeluarIndoPerBulan::pluck('Pelabuhan')->unique()->toArray());
        $this->testDispatch();
    }

    public function testDispatch()
    {
        // Jika salah satu dari selected arrays kosong, set chartData kosong
        if (empty($this->selectedKapal) || empty($this->selectedPendekatan) || empty($this->selectedPelabuhan)) {
            $chartData = [
                'kapal_masuk' => [],
                'kapal_keluar' => [],
            ];

            $this->dispatch('chart311Update', response()->json($chartData));
            return;
        }

        $query = DB::table('masukKeluarIndoPerBulan')
            ->selectRaw("
            Bulan AS 'x',
            SUM(Masuk) AS 'kapal_masuk',
            SUM(Keluar) AS 'kapal_keluar'
        ");

        // Terapkan filter berdasarkan selectedKapal, selectedPendekatan, dan selectedPelabuhan
        if (!empty($this->selectedKapal)) {
            $query->whereIn('Kapal', $this->selectedKapal);
        }

        if (!empty($this->selectedPendekatan)) {
            $query->whereIn('Pendekatan', $this->selectedPendekatan);
        }

        if (!empty($this->selectedPelabuhan)) {
            $query->whereIn('Pelabuhan', $this->selectedPelabuhan);
        }

        $results = $query->groupBy('Bulan')
            // ->orderByRaw("FIELD(Bulan, 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec')")
            ->get();

        // Susun data untuk ApexCharts
        $chartData = [
            'kapal_masuk' => [],
            'kapal_keluar' => [],
        ];

        foreach ($results as $result) {
            $chartData['kapal_masuk'][] = [
                'x' => $result->x,
                'y' => $result->kapal_masuk,
            ];

            $chartData['kapal_keluar'][] = [
                'x' => $result->x,
                'y' => $result->kapal_keluar,
            ];
        }

        $this->dispatch('chart311Update', response()->json($chartData));
    }


    public function dd()
    {
        dd($this->all());
    }

    public function render()
    {
        $kapalOptions = array_values(masukKeluarIndoPerBulan::pluck('Kapal')->unique()->toArray()); // Ubah sesuai nama kolom model Anda
        $pendekatanOptions = array_values(masukKeluarIndoPerBulan::pluck('Pendekatan')->unique()->toArray()); // Ubah sesuai nama kolom model Anda
        $pelabuhanOptions = array_values(masukKeluarIndoPerBulan::pluck('Pelabuhan')->unique()->toArray()); // Ubah sesuai nama kolom model Anda
        // dd($kapalOptions, $pendekatanOptions, $pelabuhanOptions);
        $this->testDispatch();
        return view('livewire.masuk-keluar.chart311', compact('kapalOptions', 'pendekatanOptions', 'pelabuhanOptions'));
    }
}
