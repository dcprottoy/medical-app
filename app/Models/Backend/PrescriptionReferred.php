<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionReferred extends Model
{
    use HasFactory;

    protected $fillable = [
        'prescription_id',
        'referred_id',
        'referred',
    ];
}
