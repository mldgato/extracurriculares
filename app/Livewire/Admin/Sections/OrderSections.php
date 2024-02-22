<?php

namespace App\Livewire\Admin\Sections;

use Livewire\Component;
use App\Models\Section;

class OrderSections extends Component
{
    public $sections;
    public function render()
    {
        $this->sections = Section::orderBy('order', 'asc')->get();
        return view('livewire.admin.sections.order-sections');
    }
    public function updateTaskOrder($sections)
    {
        foreach ($sections as $section) {
            Section::find($section['value'])->update(['order' => $section['order']]);
            $this->dispatch('showAlert', 'Información actualizada', 'Se modificó el orden de las secciones exitosamente.', 'success');
        }
    }
}
