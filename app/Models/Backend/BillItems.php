<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class BillItems extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_name',
        'service_type_id',
        'investigation_type_id',
        'investigation_group_id',
        'service_category_id',
        'price',
        'discount_per',
        'discount_amount',
        'final_price',
        'status'
    ];

    public function type(): BelongsTo
        {
            return $this->BelongsTo(ServiceType::class, 'service_type_id');
        }

}
