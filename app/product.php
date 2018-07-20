<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $fillable = ['title', 'subtitle', 'weight', 'avatar', 'play_duration', 'level1', 'level2',  'updated_at', 'created_at'];

    public function menu() {
        return $this->belongsTo('App\Menu', 'level1', 'level1_seq');
    }
}

