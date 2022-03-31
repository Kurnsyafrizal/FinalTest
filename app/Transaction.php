<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = "transactions";

    public function item()
    {
        return $this->hasOne('App\MasterItem','id', 'item_id');
    }

    public function location()
    {
        return $this->hasOne('App\MasterLocation','id', 'location_id');
    }

    public function user()
    {
        return $this->hasOne('App\User','id', 'user_id');
    }
}
