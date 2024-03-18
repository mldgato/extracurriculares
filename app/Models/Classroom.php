<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = ['cycle_id', 'level_id', 'grade_id', 'section_id'];

    //Relación uno a muchos inversa

    public function cycle()
    {
        return $this->belongsTo(Cycle::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    //Relación uno a muchos
    public function classroomStudents()
    {
        return $this->hasMany(ClassroomStudent::class);
    }
}
