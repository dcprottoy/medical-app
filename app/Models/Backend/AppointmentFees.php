<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AppointmentFees extends Model
{
    use HasFactory;

    protected $fillable = [
        'day_diff',
        'appointment_type_id',
        'fee_amount',
        'is_default',
        'status'
    ];

    public function appointmenttype(): BelongsTo
    {
        return $this->belongsTo(AppointmentType::class, 'appointment_type_id');
    }
}
