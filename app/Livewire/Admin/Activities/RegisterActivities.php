<?php

namespace App\Livewire\Admin\Activities;

use Livewire\Component;
use App\Models\Student;
use App\Models\Enrollment;

class RegisterActivities extends Component
{
    public $activity;

    protected $listeners = ['render', 'enroll'];
    

    public function render()
    {
        $activities = auth()->user()->activities;
        return view('livewire.admin.activities.register-activities', compact('activities'));
    }

    public function enroll($codschool)
    {
        $student = Student::where('codschool', $codschool)->first();

        if ($student) {
            $enrollment = Enrollment::where('student_id', $student->id)
                ->where('activity_id', $this->activity->id)
                ->exists();
            if (!$enrollment) {
                Enrollment::create(
                    [
                        'student_id' => $student->id,
                        'user_id' => auth()->user()->id,
                        'activity_id' => $this->activity->id,
                        'registrationdate' => date('Y-m-d H:i:s')
                    ]
                );
                $this->dispatch('closeModalMessaje', 'Información guardada', 'Estudiantes registrado exitosamente.', 'success', 'CreateNewCycle');
            }
        } else {
            $this->dispatch('closeModalMessaje', 'Información', 'No se ha podido registrar al estudiante, el código no ha sido encontrado en el sistema.', 'info', 'null');
        }
    }
}
