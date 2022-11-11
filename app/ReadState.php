<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReadState extends Model
{
    //
    public $timestamps = false; 
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function book()
    {
        return $this->belongsTo('App\Book');
    }
}
