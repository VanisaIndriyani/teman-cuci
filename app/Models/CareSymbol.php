<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareSymbol extends Model
{
    protected $fillable = [
        'category_id',
        'iso_code',
        'name',
        'image_path',
        'description_short',
        'description_long',
        'sort_order',
        'views'
    ];

    public function category()
    {
        return $this->belongsTo(SymbolCategory::class, 'category_id');
    }
}
