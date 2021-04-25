<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    public function auto()
    {
        return $this->belongsToMany('App\Models\Auto', 'auto_rates', 'rate_id', 'auto_id');
    }
}
