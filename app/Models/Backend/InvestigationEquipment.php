<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestigationEquipment extends Model
{
    use HasFactory;

    protected $fillable = [
            'equipment_name',
            'status',
            'price',
            'discount_per',
            'discount_amount',
            'final_price'
    ];
}
