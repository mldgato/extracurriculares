<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cycle extends Model
{
    use HasFactory;

    protected $fillable = ['cycle_name', 'order'];

    //Relación uno a muchos
    public function classroom()
    {
        return $this->hasMany(Classroom::class);
    }
}
