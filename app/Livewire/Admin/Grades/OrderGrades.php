<?php

namespace App\Livewire\Admin\Grades;

use Livewire\Component;
use App\Models\Grade;

class OrderGrades extends Component
{
    public $grades;
    public function render()
    {
        $this->grades = Grade::orderBy('order', 'asc')->get();
        return view('livewire.admin.grades.order-grades');
    }
    public function updateTaskOrder($grades)
    {
        foreach ($grades as $grade) {
            Grade::find($grade['value'])->update(['order' => $grade['order']]);
            $this->dispatch('showAlert', 'Información actualizada', 'Se modificó el orden de los grados exitosamente.', 'success');
        }
    }
}
