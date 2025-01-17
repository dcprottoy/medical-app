<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class InvestigationSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'investigation_main_id',
        'section_name',
        'serial'
];

public function main(): BelongsTo
    {
        return $this->BelongsTo(BillItems::class, 'investigation_main_id');
    }
}
