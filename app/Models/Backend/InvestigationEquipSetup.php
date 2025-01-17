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
        'investigation_equip_id',
        'quantity',
        'status'
    ];


    public function main(): BelongsTo
        {
            return $this->BelongsTo(BillItems::class, 'investigation_main_id');
        }

        public function equip(): BelongsTo
        {
            return $this->BelongsTo(BillItems::class, 'investigation_equip_id');
        }
}
