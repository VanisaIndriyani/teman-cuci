<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetergentRecommendation extends Model
{
    protected $fillable = [
        'fabric',
        'method_code',
        'detergent_name',
        'detergent_type',
        'description'
    ];
}
