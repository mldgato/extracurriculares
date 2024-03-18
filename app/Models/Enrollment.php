<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Enrollment extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'create_at', 'update_at'];

    //Relación uno a muchos inversa
    public function classroomStudent()
    {
        return $this->belongsTo(ClassroomStudent::class);
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    //Otros métodos
    public function formattedRegistrationDate()
    {
        return Carbon::parse($this->registrationdate)->format('d/m/Y H:i:s');
    }
}
