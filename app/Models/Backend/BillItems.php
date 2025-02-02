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
        'duration',
        'price',
        'discount_per',
        'discount_amount',
        'final_price',
        'status'
    ];

    public function serviceType(): BelongsTo
        {
            return $this->BelongsTo(ServiceType::class, 'service_type_id');
        }

    public function investigationType(): BelongsTo
    {
        return $this->BelongsTo(InvestigationType::class, 'investigation_type_id');
    }

    public function investigationGroup(): BelongsTo
    {
        return $this->BelongsTo(InvestigationGroup::class, 'investigation_group_id');
    }

    public function serviceCategory(): BelongsTo
    {
        return $this->BelongsTo(InvestigationGroup::class, 'investigation_group_id');
    }

}
