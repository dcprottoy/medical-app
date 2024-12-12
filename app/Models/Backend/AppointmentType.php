<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_eng',
        'name_bang',
        'status'
    ];
}
