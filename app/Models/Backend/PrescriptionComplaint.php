<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionComplaint extends Model
{
    use HasFactory;
    protected $fillable = [
        'prescription_id',
        'complaint_id',
        'complaint',
        'complaint_duration',
        'complaint_duration_id',
        'complaint_duration_value',
        'complaint_duration_value_id',
        'created_by',
        'updated_by'
    ];
}
