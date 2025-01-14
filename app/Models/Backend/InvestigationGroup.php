<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestigationGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_eng',
        'room_no',
        'status'
    ];
}
