<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'bill_main_id',
        'patient_id',
        'service_category_id',
        'referrence_id',
        'item_id',
        'bill_date',
        'delivery_date',
        'price',
        'quantity',
        'final_price',
        'discount_percent',
        'discount_amount'
    ];

}
