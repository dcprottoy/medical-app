<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestigationType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_eng',
        'status'
    ];
}