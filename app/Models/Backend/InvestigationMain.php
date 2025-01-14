<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class InvestigationMain extends Model
{
    use HasFactory;

    protected $fillable = [
        'investigation_name',
        'investigation_type_id',
        'investigation_group_id',
        'status',
        'price',
        'discount_per',
        'discount_amount',
        'final_price',

];

    public function type(): BelongsTo
    {
        return $this->BelongsTo(InvestigationType::class, 'investigation_type_id');
    }

    public function group(): BelongsTo
    {
        return $this->BelongsTo(InvestigationGroup::class, 'investigation_group_id');
    }

}
