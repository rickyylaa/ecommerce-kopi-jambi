<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'description', 'status'];

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

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
