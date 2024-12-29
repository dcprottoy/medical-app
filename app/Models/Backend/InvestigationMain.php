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
        'status',
        'price',
        'discount_per',
        'discount_amount'
];

public function type(): BelongsTo
    {
        return $this->BelongsTo(InvestigationType::class, 'investigation_type_id');
    }


}
