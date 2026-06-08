<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RbfRule extends Model
{
    protected $fillable = [
        'rule_code',
        'fabric',
        'color',
        'motif',
        'dirt_level',
        'condition_desc',
        'eliminated_method',
        'reason',
        'iso_ref',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
