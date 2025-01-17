<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvestigationDetails extends Model
{
    use HasFactory;

    protected $fillable = [
                'investigation_main_id',
                'investigation_section_id',
                'details_name',
                'refference_value',
                'serial'
    ];

    public function main(): BelongsTo
        {
            return $this->BelongsTo(BillItems::class, 'investigation_main_id');
        }

    public function section(): BelongsTo
        {
            return $this->BelongsTo(InvestigationSection::class, 'investigation_section_id');
        }
}
