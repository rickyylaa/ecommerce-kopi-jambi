<?php

namespace App\Http;

use App\Models\Product;
use Illuminate\Support\Facades\Request;

class Helper
{
    public static function getCarts()
    {
        $carts = json_decode(Request::cookie('kopi-jambi'), true) ?? [];
        return $carts;
    }

    public static function cartCount()
    {
        $carts = self::getCarts();
        $totalCount = 0;

        foreach ($carts as $cartItem) {
            $totalCount += $cartItem['qty'];
        }

        return $totalCount;
    }

    public static function getTotalCartPrice()
    {
        $carts = self::getCarts();
        $totalPrice = 0;

        foreach ($carts as $cartItem) {
            $totalPrice += $cartItem['qty'] * $cartItem['product_price'];
        }

        return $totalPrice;
    }

    public static function getAllProductsInCart()
    {
        $carts = self::getCarts();
        $productsInCart = [];

        foreach ($carts as $cartItem) {
            $product = Product::find($cartItem['product_id']);

            if ($product) {
                $cartItem['product'] = $product;
                $productsInCart[] = $cartItem;
            }
        }

        return $productsInCart;
    }
}
