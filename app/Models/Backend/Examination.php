<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_eng',
        'symbol',
        'serial',
        'side',
        'status',
        'created_by',
        'updated_by'
    ];
}
