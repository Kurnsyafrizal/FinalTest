<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterItem extends Model
{
    //mendefinisikan
    protected $table = "master_items";

    public function um()
    {   
        //
        return $this->hasOne(Um::class,'id', 'um_id');
    }
}
