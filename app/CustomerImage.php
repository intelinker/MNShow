<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerImage extends Model
{
    protected $fillable = ['name', 'link', 'type', 'order', 'description', 'customer_id'];
}
