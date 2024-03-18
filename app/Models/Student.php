<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'create_at', 'update_at'];

    //Relación uno a muchos
    public function classroomStudents()
    {
        return $this->hasMany(ClassroomStudent::class);
    }

    /* public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    } */
}
