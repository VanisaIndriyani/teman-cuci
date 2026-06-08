<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SawWeight extends Model
{
    protected $fillable = [
        'criterion_code',
        'criterion_name',
        'weight',
        'type',
        'updated_by'
    ];

    public function updater()
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }
}
