<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourierType extends Model
{
    use HasFactory;

    protected $fillable = [
        "courier_id",
        "nama",
        "harga",
    ];

    public function courier()
    {
        return $this->belongsTo(Courier::class);
    }
}
