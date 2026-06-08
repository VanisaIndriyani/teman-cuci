<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WashingStep extends Model
{
    protected $fillable = [
        'method_code',
        'step_order',
        'title',
        'description',
        'tip'
    ];
}
