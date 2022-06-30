<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function cost(Request $request): \Illuminate\Http\JsonResponse
    {
        $weight = cart_items()->sum(function ($item) { return $item->product->weight * 1000; });
        $data = [
            'origin'        => (int) setting('city_origin_id'),
            'destination'   => (int) $request->get('city_id'),
            'weight'        => $weight,
            'courier'       => $request->get('shipping_name'),
        ];
        $cost = RajaOngkir::ongkosKirim($data)->get();
        return response()->json($cost);
    }
}
