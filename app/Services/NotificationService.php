<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NotificationService
{
    public static function getNotifications()
    {
        $user = Auth::guard('customer')->user();

        if ($user) {
            return DB::table('customers')
                ->leftJoin('messages', function ($join) use ($user) {
                    $join->on('customers.id', '=', 'messages.customer_id')
                        ->where('messages.is_read', '=', 0)
                        ->where('messages.customer_id', '=', $user->id);
                })
                ->leftJoin('products', 'products.id', '=', 'messages.product_id')
                ->leftJoin('orders', 'orders.id', '=', 'messages.order_id')
                ->select(
                    'customers.id as customer_id',
                    'customers.first_name',
                    'customers.last_name',
                    'customers.email',
                    'customers.phone',
                    'messages.id as message_id',
                    DB::raw('COUNT(messages.is_read) as unread')
                )
                ->groupBy('customers.id', 'customers.first_name', 'customers.last_name', 'customers.email', 'customers.phone', 'messages.id')
                ->get();
        } else {
            return [];
        }
    }
}
