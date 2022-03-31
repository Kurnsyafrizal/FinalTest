<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use SoftDeletes;
    protected $table = "stocks";

    public function item()
    {
        return $this->hasOne('App\MasterItem','id', 'item_id');
    }

    public function location()
    {
        return $this->hasOne('App\MasterLocation','id', 'location_id');
    }
}
