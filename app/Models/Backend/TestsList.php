<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestsList extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name_eng',
        'name_bang',
        'status'
    ];
}
