<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctors extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'contact_no',
        'emr_cont_no',
        'address',
        'birth_date',
        'degree',
        'sex'
    ];
}
