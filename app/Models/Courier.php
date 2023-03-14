<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    use HasFactory;

    protected $fillable = [
        "nama",
    ];

    public function courier_types()
    {
        return $this->hasMany(CourierType::class);
    }
}
