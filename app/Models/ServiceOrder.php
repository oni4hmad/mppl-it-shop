<?php

namespace App\Models;

use App\Enums\ServiceOrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceOrder extends Model
{
    use HasFactory;

    protected $guarded = [
        "id",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function technician()
    {
        return $this->belongsTo(Technician::class);
    }

    public function address_order()
    {
        return $this->belongsTo(AddressOrder::class);
    }

    public function scopeActive($query)
    {
        return $query->whereIn('status', [ServiceOrderStatus::MENUNGGU_KONFIRMASI_TEKNISI, ServiceOrderStatus::DALAM_SERVIS]);
    }

}
