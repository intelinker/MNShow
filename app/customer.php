<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    protected $fillable = ['name', 'store_count', 'channel_category1', 'channel_category2', 'channel_category3'
        , 'visit_time', 'contract_time', 'contract_duration', 'progress', 'created_by', 'created_at'];

    public function channel1() {
        return $this->hasOne('App\Channel', "id", "channel_category1");
    }

    public function channel2() {
        return $this->hasOne('App\Channel', "id", "channel_category2");
    }

    public function channel3() {
        return $this->hasOne('App\Channel', "id", "channel_category3");
    }

    public function image() {
        return $this->hasMany("App\CustomerImage", "customer_id", "id");
    }

    public function product() {
        return $this->hasMany("App\product", "id", "corpration_products");
    }

    public function creator() {
        return $this->hasOne("App\User", "id", "created_by");
    }
}
