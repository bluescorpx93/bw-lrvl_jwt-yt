<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
  public function user(){
    return $this-belongsTo('App\User');
  }
}
