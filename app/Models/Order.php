<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;
    public function customer()
    {
        return $this->belongsTo(Customer_info::class);
    }
    public function orderDetail() {
        return $this->hasMany(OrderDetail::class);
    }
}
