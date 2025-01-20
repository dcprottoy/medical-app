<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

use Illuminate\Database\Eloquent\Model;

class BillMain extends Model
{
    use HasFactory;


    protected $fillable = [
        'bill_id',
        'patient_id',
        'patient_name',
        'referrence_id',
        'bill_date',
        'total_amount',
        'payable_amount',
        'discount_percent',
        'discount_amount',
        'paid_amount',
        'due_amount',
        'return_amount',
        'returned_status',
        'paid_status'
    ];

    public function patient(): HasOne
    {
        return $this->hasOne(Patients::class, 'patient_id', 'patient_id');
    }
}
