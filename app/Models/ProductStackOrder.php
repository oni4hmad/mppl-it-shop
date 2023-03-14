<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStackOrder extends Model
{
    use HasFactory;

    protected $guarded = [
        "id",
    ];

    public function photo()
    {
        return $this->morphOne(Photo::class, 'photoable');
    }
}
