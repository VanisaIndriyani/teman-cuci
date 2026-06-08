<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'description',
        'updated_by'
    ];

    public function updater()
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }
}
