<?php

namespace App\Models\Web\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function getAllOrders(){
        return Order::all();
    }

}
