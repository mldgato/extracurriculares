<?php

namespace App\Livewire\Admin\Students;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Student;

class ShowStudents extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public $search = '';
    public $sort = 'lastname';
    public $direction = 'asc';
    public $cant = '50';
    public $readyToLoad = false;

    protected $queryString = [
        'cant' => ['except' => '50'],
        'search' => ['except' => '']
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCant()
    {
        $this->resetPage();
    }

    public function render()
    {
        if ($this->readyToLoad) {
            $students = Student::where('firstname', 'LIKE', '%' . $this->search . '%')
                ->orwhere('lastname', 'LIKE', '%' . $this->search . '%')
                ->orwhere('codschool', 'LIKE', '%' . $this->search . '%')
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);
        } else {
            $students = [];
        }
        return view('livewire.admin.students.show-students', compact('students'));
    }
    public function loadStudents()
    {
        $this->readyToLoad = true;
    }
    public function order($sort)
    {
        if ($this->sort == $sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'desc';
        }
    }
}
