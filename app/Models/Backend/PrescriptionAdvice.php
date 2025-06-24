<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionAdvice extends Model
{
    use HasFactory;

    protected $fillable = [
        'prescription_id',
        'advice_id',
        'advice_value'
    ];
}
