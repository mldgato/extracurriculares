<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassroomStudent extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'create_at', 'update_at'];

    //Relación uno a muchos inversa
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}
