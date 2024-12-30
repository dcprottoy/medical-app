<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\InvestigationMain;

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
        return $this->BelongsTo(InvestigationMain::class, 'investigation_main_id');
    }
}
