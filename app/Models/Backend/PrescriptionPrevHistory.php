<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionPrevHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'prescription_id',
        'history_id',
        'history_value'
    ];
}
