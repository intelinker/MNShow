<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['name', 'level1_seq', 'level2_seq', 'visible', 'avatar', 'level2_contents'];

    public function product() {
        return $this->hasMany('App\product', 'id');
    }
}
