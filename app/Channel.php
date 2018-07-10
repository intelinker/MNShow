<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = ['name', 'level1_id', 'level2_id', 'level',];

    public function channel1() {
        return $this->hasOne('App\Channel', 'id', 'level1_id');
    }

    public function channel2() {
        return $this->hasOne('App\Channel', 'id', 'level2_id');
    }

//    public function haschannel2() {
//        return $this->hasMany('App\Channel', 'level1_id', 'id');
//    }
//
//    public function haschannel3() {
//        return $this->hasMany('App\Channel', 'level2_id', 'id');
//    }

    public function customer() {
        return $this->belongsTo('App\customer');
    }
}
