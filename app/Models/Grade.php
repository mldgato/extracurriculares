<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = ['grade_name', 'grade_short_name', 'practices', 'order'];

    //Relación uno a muchos
    public function classroom()
    {
        return $this->hasMany(Classroom::class);
    }
}
