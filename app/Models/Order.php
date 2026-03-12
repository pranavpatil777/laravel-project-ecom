<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'status', 'total', 'shipping_address'];

    protected $casts = ['total' => 'decimal:2'];
}
