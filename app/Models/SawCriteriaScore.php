<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SawCriteriaScore extends Model
{
    protected $fillable = ['method_code', 'criterion_code', 'attribute_value', 'score'];
}
