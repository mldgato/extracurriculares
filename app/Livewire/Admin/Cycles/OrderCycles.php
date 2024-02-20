<?php

namespace App\Livewire\Admin\Cycles;

use Livewire\Component;
use App\Models\Cycle;

class OrderCycles extends Component
{
    public $cycles;

    public function render()
    {
        $this->cycles = Cycle::orderBy('order', 'asc')->get();
        return view('livewire.admin.cycles.order-cycles');
    }

    public function updateTaskOrder($cycles)
    {
        foreach($cycles as $cycle)
        {
            Cycle::find($cycle['value'])->update(['order' => $cycle['order']]);
            $this->dispatch('showAlert', 'Información actualizada', 'Se modificó el orden de los ciclos exitosamente.', 'success');
        }
    }
}
