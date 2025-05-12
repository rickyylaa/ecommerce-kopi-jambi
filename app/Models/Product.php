<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'category_id', 'brand_id', 'size_id', 'price', 'weight', 'qty', 'image', 'summary', 'description', 'status' ];

    public function getStatusLabelAttribute()
    {
        if ($this->status == 0) {
            return '<div class="badge badge-soft-warning font-size-12">Tidak Aktif</div>';
        }
        return '<div class="badge badge-soft-primary font-size-12">Aktif</div>';
    }

    public function getStsLabelAttribute()
    {
        if ($this->status == 0) {
            return 'Tidak Aktif';
        }
        return 'Aktif';
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
