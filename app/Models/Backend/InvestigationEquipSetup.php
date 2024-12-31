<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class InvestigationEquipSetup extends Model
{
    use HasFactory;

    protected $fillable = [
        'investigation_main_id',
        'quantity',
        'status'
    ];


    public function main(): BelongsTo
        {
            return $this->BelongsTo(InvestigationMain::class, 'investigation_main_id');
        }
}
