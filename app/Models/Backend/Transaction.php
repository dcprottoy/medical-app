<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'patient_id',
        'patient_name',
        'referrence_id',
        'service_category_id',
        'transaction_date',
        'prev_due',
        'prev_paid',
        'total_amount',
        'payable_amount',
        'discount_percent',
        'discount_amount',
        'paid_amount',
        'due_amount',
        'return_amount',
        'returned_status',
        'paid_status',
        'created_by'
    ];
}
