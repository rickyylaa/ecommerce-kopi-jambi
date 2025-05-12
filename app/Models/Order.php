<?php

namespace App\Models;

use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['status_label', 'commission', 'total'];

    public function getStatusLabelAttribute()
    {
        if ($this->status == 0) {
            return '<div class="badge badge-soft-primary font-size-12">Pending</div>';
        } elseif ($this->status == 1) {
            return '<div class="badge badge-soft-primary font-size-12">Lunas</div>';
        } elseif ($this->status == 2) {
            return '<div class="badge badge-soft-primary font-size-12">Diproses</div>';
        } elseif ($this->status == 3) {
            return '<div class="badge badge-soft-primary font-size-12">Dikirim</div>';
        }
        return '<div class="badge badge-soft-primary font-size-12">Selesai</div>';
    }

    public function getStsLabelAttribute()
    {
        if ($this->status == 0) {
            return 'Pending';
        } elseif ($this->status == 1) {
            return 'Lunas';
        } elseif ($this->status == 2) {
            return 'Diproses';
        } elseif ($this->status == 3) {
            return 'Dikirim';
        }
        return 'Selesai';
    }

    public function getCommissionAttribute()
    {
        $commission = ($this->subtotal * 10) / 100;
        return $commission > 10000 ? 10000:$commission;
    }

    public function getTotalAttribute()
    {
        return $this->subtotal + $this->cost;
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function return()
    {
        return $this->hasOne(OrderReturn::class);
    }

    public function order()
    {
        return $this->hasOne(Order::class);
    }
}
