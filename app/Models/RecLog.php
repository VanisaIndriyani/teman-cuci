<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecLog extends Model
{
    public $timestamps = false; // We use a manual created_at timestamp in migration

    protected $fillable = [
        'session_id',
        'fabric',
        'color',
        'motif',
        'dirt_level',
        'is_batik_modern',
        'is_poly_blend',
        'is_denim_new',
        'is_sablon_rubber',
        'is_bordir_small',
        'passed_methods',
        'top_method',
        'saw_scores',
        'created_at'
    ];

    protected $casts = [
        'passed_methods' => 'json',
        'saw_scores' => 'json',
        'is_batik_modern' => 'boolean',
        'is_poly_blend' => 'boolean',
        'is_denim_new' => 'boolean',
        'is_sablon_rubber' => 'boolean',
        'is_bordir_small' => 'boolean',
        'created_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->created_at = $model->freshTimestamp();
        });
    }
}
