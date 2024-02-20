<?php

namespace App\Livewire\Admin\Levels;

use Livewire\Component;
use App\Models\Level;

class OrderLevels extends Component
{
    public $levels;
    public function render()
    {
        $this->levels = Level::orderBy('order', 'asc')->get();
        return view('livewire.admin.levels.order-levels');
    }
    public function updateTaskOrder($levels)
    {
        foreach ($levels as $level) {
            Level::find($level['value'])->update(['order' => $level['order']]);
            $this->dispatch('showAlert', 'Información actualizada', 'Se modificó el orden de los niveles exitosamente.', 'success');
        }
    }
}
