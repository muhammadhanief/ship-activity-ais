<?php

namespace App\Livewire\KunjunganKeLuarNegeri;

use Livewire\Component;
use App\Models\masukKeluarLnPerBulan;

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
            // $chartData = [];
        } else {
            $this->emit('dispatch522', $this->selectedPendekatan);
        }
    }

    public function render()
    {
        return view('livewire.kunjungan-ke-luar-negeri.chart522');
    }
}
