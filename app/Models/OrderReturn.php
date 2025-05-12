<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderReturn extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['status_label'];

    public function getStatusLabelAttribute()
    {
        if ($this->status == 0) {
            return '<div class="badge badge-soft-primary font-size-12">Menunggu Konfirmasi</div>';
        } elseif ($this->status == 1) {
            return '<div class="badge badge-soft-primary font-size-12">Disetujui</div>';
        }
        return '<div class="badge badge-soft-primary font-size-12">Ditolak</div>';
    }

    public function getStsLabelAttribute()
    {
        if ($this->status == 0) {
            return 'Menunggu Konfirmasi';
        } elseif ($this->status == 1) {
            return 'Disetujui';
        }
        return 'Ditolak';
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
