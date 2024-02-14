<?php

namespace App\Livewire\Admin\Cycles;

use Livewire\Component;
use App\Models\Cycle;

class CreateCycle extends Component
{
    public $cycle_name;
    public $order = 0;

    protected $rules = [
        'cycle_name' => 'required|unique:cycles|numeric|digits:4'
    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function save()
    {
        $this->validate();
        Cycle::create(
            [
                'cycle_name' => $this->cycle_name,
                'order' => $this->order
            ]
        );
        $this->reset([
            'cycle_name'
        ]);
        $this->dispatchTo('admin.cycles.show-cycles', 'render');
        $this->dispatch('closeModalMessaje', 'Información guardada', 'Ciclo creado exitosamente.', 'success', 'CreateNewCycle');
    }

    public function render()
    {
        return view('livewire.admin.cycles.create-cycle');
    }

    public function resetFields()
    {
        $this->reset([
            'cycle_name'
        ]);
    }
}
