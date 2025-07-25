<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoseFrequency extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_eng',
        'name_bang',
        'status'
    ];
}
