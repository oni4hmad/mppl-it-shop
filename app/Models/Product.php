<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use Sluggable;

    protected $guarded = [
        'id'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama'
            ]
        ];
    }

    public function scopeFilter(Builder $query, array $filters)
    {
        $query->when($filters['search'], function ($query, $search) {
            return $query->where('nama', 'like', '%' . $search . '%');
        });
        $query->when($filters['category'], function ($query, $search) {
            return $query->where('category_id', Category::where('slug', $search)->first()->id);
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function productStackCarts()
    {
        return $this->hasMany(ProductStackCart::class);
    }

    public function photo_1()
    {
        return $this->belongsTo(Photo::class, 'photo_id_1');
    }

    public function photo_2()
    {
        return $this->belongsTo(Photo::class, 'photo_id_2');
    }

    public function photo_3()
    {
        return $this->belongsTo(Photo::class, 'photo_id_3');
    }

    public function photo_4()
    {
        return $this->belongsTo(Photo::class, 'photo_id_4');
    }
}
