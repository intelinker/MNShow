<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    protected $fillable = ['name', 'store_count', 'channel_category1', 'channel_category2', 'channel_category3'
        , 'visit_time', 'contract_time', 'contract_duration', 'progress', 'created_by', 'created_at'];

    public function channel() {
        return $this->hasMany('App\Channel');
    }

    public function image() {
        return $this->hasMany("App\CustomerImage", "customer_id", "id");
    }
}
