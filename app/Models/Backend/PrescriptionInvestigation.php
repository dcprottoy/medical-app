<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionInvestigation extends Model
{
    use HasFactory;

    protected $fillable = [
        'prescription_id',
        'investigations_id',
        'investigations_value'
    ];
}
