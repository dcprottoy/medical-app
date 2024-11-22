<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;
// use App\Models\Backend\Patients;


class Appoinments extends Model
{
    use HasFactory;

    protected $fillable = [
        'appoint_id',
        'patient_id',
        'doctor_id',
        'appointed_date',
        'note',
        'serial'
    ];

    public function patient(): HasOne
    {
        return $this->hasOne(Patients::class, 'patient_id', 'patient_id');
    }

}
