<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SymbolCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'sort_order'
    ];

    public function careSymbols()
    {
        return $this->hasMany(CareSymbol::class, 'category_id');
    }
}
