<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    use HasFactory;

    protected $guarded = [
        "id"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product_stack_orders()
    {
        return $this->hasMany(ProductStackOrder::class);
    }

    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function address_order()
    {
        return $this->belongsTo(AddressOrder::class);
    }

    public function courier_type()
    {
        return $this->belongsTo(CourierType::class);
    }

    public function courier()
    {
        return $this->hasOneThrough(
            Courier::class,
            CourierType::class,
            'id',
            'id',
            'courier_type_id',
            'courier_id'
        );
    }

    public function bukti_pembayaran()
    {
        return $this->morphOne(Photo::class, 'photoable');
    }
}
