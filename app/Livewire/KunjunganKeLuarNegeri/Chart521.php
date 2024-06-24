<?php

namespace App\Livewire\KunjunganKeLuarNegeri;

use Livewire\Component;
use App\Models\masukKeluarLnPerTipeKapal;
use Illuminate\Support\Facades\DB;

class Chart521 extends Component
{
    public $selectedPendekatan = [];
    public $selectedPelabuhan = [];
    public $selectAllPelabuhan = true;


    public function updatedSelectedPendekatan()
    {
        $this->dispatch521();
    }

    public function updatedSelectedPelabuhan()
    {
        $this->dispatch521();
    }

    public function updatedSelectAllPelabuhan()
    {
        if ($this->selectAllPelabuhan) {
            $this->selectedPelabuhan = array_values(masukKeluarLnPerTipeKapal::pluck('Pelabuhan')->unique()->toArray());
        } else {
            $this->selectedPelabuhan = [];
        }
    }

    public function mount()
    {
        $this->selectedPendekatan = array_values(masukKeluarLnPerTipeKapal::pluck('Pendekatan')->unique()->toArray());
        $this->selectedPelabuhan = array_values(masukKeluarLnPerTipeKapal::pluck('Pelabuhan')->unique()->toArray());
    }

    public function dispatch521()
    {
        // Siapkan format data default
        $formattedData = [
            'categories' => [],
            'series' => [
                ['name' => 'Kapal Masuk', 'data' => []],
                ['name' => 'Kapal Keluar', 'data' => []]
            ]
        ];

        // Cek jika selectedPendekatan atau selectedPelabuhan kosong
        if (!empty($this->selectedPendekatan) && !empty($this->selectedPelabuhan)) {
            // Ambil data dari database sesuai filter
            $data = MasukKeluarLnPerTipeKapal::select('Tipe_Kapal', DB::raw('SUM(Masuk) as totalMasuk, SUM(Keluar) as totalKeluar'))
                ->whereIn('Pendekatan', $this->selectedPendekatan)
                ->whereIn('Pelabuhan', $this->selectedPelabuhan)
                ->groupBy('Tipe_Kapal')
                ->orderBy('totalMasuk', 'desc')
                ->limit(10)
                ->get();

            // Isi formattedData dengan data dari query
            foreach ($data as $item) {
                $formattedData['categories'][] = $item->Tipe_Kapal;
                $formattedData['series'][0]['data'][] = $item->totalMasuk;
                $formattedData['series'][1]['data'][] = $item->totalKeluar;
            }
        }

        // Emit formattedData ke event kunjunganKeLuarNegeriChart521
        $this->dispatch('chart521Update', $formattedData);
    }



    public function render()
    {
        $pendekatanOptions = masukKeluarLnPerTipeKapal::pluck('Pendekatan')->unique();
        $pelabuhanOptions = masukKeluarLnPerTipeKapal::pluck('Pelabuhan')->unique();
        $this->dispatch521();
        return view('livewire.kunjungan-ke-luar-negeri.chart521', compact('pendekatanOptions', 'pelabuhanOptions'));
    }
}
