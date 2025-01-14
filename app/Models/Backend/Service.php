<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Service extends Model
{
    use HasFactory;

    protected $fillable = [

        'service_name',
        'service_type_id',
        'status',
        'price',
        'discount_per',
        'discount_amount',
        'final_price'

        ];

        public function type(): BelongsTo
        {
            return $this->BelongsTo(ServiceType::class, 'service_type_id');
        }
}
