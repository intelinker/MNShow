<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Authority extends Model
{
    protected $fillable = ['name'];

    public function users() {
        return $this->belongsTo('App\Users', 'id');
    }
}
