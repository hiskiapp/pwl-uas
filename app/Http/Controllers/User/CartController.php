<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CartRequest;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $cartItems = cart_items();
        $cartSubtotal = cart_subtotal();

        return view('user.cart.index', compact('cartItems', 'cartSubtotal'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CartRequest $request
     * @return RedirectResponse
     */
    public function store(CartRequest $request): \Illuminate\Http\RedirectResponse
    {
        $userId = auth()->id();
        $productId = $request->input('product_id');
        $total_order = $request->input('total_order');

        $cart = Cart::where([
            'user_id' => $userId,
            'product_id' => $productId,
        ])->first();

        if($cart){
            $cart->total_order += $total_order;
        } else {
            $cart = new Cart();
            $cart->user_id = $userId;
            $cart->product_id = $productId;
            $cart->total_order = $total_order;
        }

        $product = Product::find($productId);
        if($product->stock < $cart->total_order) {
            $cart->total_order = $product->stock;
        }

        $cart->save();

        return redirect()->route('user.cart.index')->with([
            'status' => 'success',
            'message' => 'Produk berhasil ditambahkan ke keranjang!'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CartRequest $request
     * @return JsonResponse
     */
    public function update(CartRequest $request): JsonResponse
    {
        $userId = auth()->id();
        $productId = $request->input('product_id');
        $total_order = $request->input('total_order');

        $cart = Cart::where([
            'user_id' => $userId,
            'product_id' => $productId,
        ])->first();

        if($cart){
            $cart->total_order = $total_order;
        }

        $cart->save();

        $product = Product::find($productId);

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diubah!',
            'total_price' => $product->price * $total_order,
            'subtotal' => cart_subtotal(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request): \Illuminate\Http\RedirectResponse
    {
        $userId = auth()->id();
        $productId = $request->input('product_id');

        $cart = Cart::where([
            'user_id' => $userId,
            'product_id' => $productId,
        ])->first();

        if($cart){
            $cart->delete();
        }

        return redirect()->route('user.cart.index')->with([
            'status' => 'success',
            'message' => 'Produk berhasil dihapus!'
        ]);
    }
}
