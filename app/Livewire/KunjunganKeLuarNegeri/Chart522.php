<?php

namespace App\Livewire\KunjunganKeLuarNegeri;

use Livewire\Component;
use App\Models\masukKeluarLnPerBulan;
use Illuminate\Support\Facades\DB;

class Chart522 extends Component
{
    public $selectedPendekatan = [];

    public function updatedSelectedPendekatan()
    {
        $this->dispatch522();
    }

    public function mount()
    {
        $this->selectedPendekatan = array_values(masukKeluarLnPerBulan::pluck('Pendekatan')->unique()->toArray());
    }

    public function dispatch522()
    {
        if (empty($this->selectedPendekatan)) {
            $formattedData = [
                'categories' => [],
                'series' => [
                    ['name' => 'Kapal Masuk', 'data' => []],
                    ['name' => 'Kapal Keluar', 'data' => []]
                ]
            ];
        } else {
            // Inisialisasi data yang akan dikirim
            $formattedData = [
                'categories' => [], // Array untuk kategori pelabuhan (sumbu x)
                'series' => [
                    ['name' => 'Kapal Masuk', 'data' => []], // Series untuk Kapal Masuk
                    ['name' => 'Kapal Keluar', 'data' => []] // Series untuk Kapal Keluar
                ]
            ];

            // Ambil data dari model atau sumber lain
            $data = MasukKeluarLnPerBulan::select('Pelabuhan', DB::raw('SUM(Masuk) as totalMasuk, SUM(Keluar) as totalKeluar'))
                ->whereIn('Pendekatan', $this->selectedPendekatan)
                ->groupBy('Pelabuhan')
                ->orderByDesc('totalMasuk') // Mengurutkan berdasarkan totalMasuk secara descending
                ->limit(10) // Mengambil 10 data teratas
                ->get();


            // Looping untuk mengisi data ke dalam $formattedData
            foreach ($data as $item) {
                $formattedData['categories'][] = $item->Pelabuhan; // Tambahkan pelabuhan ke array categories
                // Tambahkan total masuk dan total keluar ke dalam data series
                $formattedData['series'][0]['data'][] = (int) $item->totalMasuk;
                $formattedData['series'][1]['data'][] = (int) $item->totalKeluar;
            }
        }

        // Dispatch event dengan data yang sudah diformat
        $this->dispatch('chart522Update', $formattedData);
    }


    public function render()
    {
        $pendekatanOptions = masukKeluarLnPerBulan::pluck('Pendekatan')->unique();
        $this->dispatch522();
        return view('livewire.kunjungan-ke-luar-negeri.chart522', compact('pendekatanOptions'));
    }
}
