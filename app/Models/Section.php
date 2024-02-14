<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = ['section_name', 'order'];

    //Relación uno a muchos
    public function classroom()
    {
        return $this->hasMany(Classroom::class);
    }
}
