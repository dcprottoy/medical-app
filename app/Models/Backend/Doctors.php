<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
// use App\Models\Backend\Departments;

class Doctors extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'contact_no',
        'emr_cont_no',
        'address',
        'birth_date',
        'department_id',
        'degree',
        'specialities',
        'sex'
    ];


    public function department(): HasOne
    {
        return $this->hasOne(Departments::class, 'id');
    }
}
