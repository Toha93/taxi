<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auto extends Model
{
    use HasFactory;

    public function rates()
  {
    return $this->belongsToMany('App\Models\Rate', 'auto_rates', 'auto_id', 'rate_id');
  }
  public function driver()
  {
    return $this->belongsToMany('App\Models\driver', 'auto_drivers', 'auto_id', 'driver_id');
  }
}
