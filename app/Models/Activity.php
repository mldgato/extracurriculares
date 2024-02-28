<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'create_at', 'update_at'];
    
    //relación muchos a muchos
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
