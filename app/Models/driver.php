<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class driver extends Model
{
    use HasFactory;
    public function auto()
  {
    return $this->belongsToMany('App\Models\Auto', 'auto_drivers', 'driver_id','auto_id' );
  }
}
