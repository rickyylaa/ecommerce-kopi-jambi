<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'image', 'summary', 'description', 'status'];

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
}
