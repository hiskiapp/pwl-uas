<?php

use App\Models\Cart;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

if (!function_exists('cart_items')) {

    /**
     * get cart items user
     *
     * @return Builder[]|Collection
     */
    function cart_items()
    {
        $userId = auth()->id();

        return Cart::with(['product'])->where('user_id', $userId)->get();
    }
}

if(!function_exists('cart_subtotal')) {
    /**
     * get cart subtotal user
     *
     * @return int
     */
    function cart_subtotal(): int
    {
        return cart_items()->sum(function($item){
            return $item->product->price * $item->total_order;
        });
    }
}
