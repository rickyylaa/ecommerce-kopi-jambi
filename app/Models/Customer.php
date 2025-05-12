<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Authenticatable
{
    use Notifiable, HasFactory;

    protected $guarded = [];

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

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
