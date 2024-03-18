<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = ['enrollment_id', 'user_id', 'attendance_date', 'attendance_time'];

    // Relación muchos a uno inversa con Enrollment
    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }
}
