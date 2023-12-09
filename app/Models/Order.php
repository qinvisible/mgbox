<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        "customer_id",
        "note",
        "total_payment",
        "remaining_payment",
        "paid",
        "payment_deadline",
    ];

    /**
     * Get all of the order_item for the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function customer() 
    {
        return $this->hasOne(Customer::class, 'id');
    }
}
