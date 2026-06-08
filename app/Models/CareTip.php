<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareTip extends Model
{
    protected $fillable = [
        'method_code',
        'fabric_filter',
        'color_filter',
        'motif_filter',
        'tip_text',
        'sort_order'
    ];
}
