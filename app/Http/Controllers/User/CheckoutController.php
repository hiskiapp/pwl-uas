<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\PaymentMethod;
use App\Models\Transaction;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\View\Factory;
use Throwable;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|RedirectResponse
     */
    public function index() {
        $cartItems = cart_items();
        if(!$cartItems->count()) {
            return redirect()->route('user.cart.index')->with([
                'status' => 'danger',
                'message' => 'Keranjang belanja kosong!'
            ]);
        }

        $transactionWaiting = Transaction::where('status', 'Waiting Payment')->first();
        if($transactionWaiting){
            return redirect()->route('user.transactions.index')->with([
                'status' => 'danger',
                'message' => 'Anda sudah memiliki transaksi yang menunggu pembayaran!'
            ]);
        }

        $cartSubtotal = cart_subtotal();
        $transactionExisting = Transaction::query()->orderBy('id', 'desc')->first();
        $paymentMethods = PaymentMethod::query()->orderBy('name', 'asc')->get();

        return view('user.checkout.index', compact('cartItems', 'cartSubtotal', 'transactionExisting', 'paymentMethods'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function store(Request $request): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $cartItems = cart_items();
            $totalItem = $cartItems->sum('total_order');
            $totalPrice = $cartItems->sum(function($item){
                return $item->product->price * $item->total_order;
            });

            $transaction = Transaction::create([
                'user_id' => auth()->id(),
                'total_price' => $totalPrice,
                'total_item' => $totalItem,
                'payment_method_id' => $request->input('payment_method_id'),
                'status' => 'Waiting Payment',
                'address1' => $request->input('address1'),
                'address2' => $request->input('address2'),
                'postcode' => $request->input('postcode'),
                'city' => $request->input('city'),
                'state' => $request->input('state'),
                'country' => $request->input('country'),
            ]);

            $transaction->transactionItems()->insert($cartItems->map(function($item) use ($transaction){
                return [
                    'transaction_id' => $transaction->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->total_order,
                    'total_price' => $item->product->price * $item->total_order,
                    'created_at' => now(),
                ];
            })->toArray());

            Cart::where('user_id', auth()->id())->delete();

            DB::commit();

            return redirect()->route('user.transactions.index')->with([
                'status' => 'success',
                'message' => 'Transaksi berhasil ditambahkan!'
            ]);
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            DB::rollBack();
            return redirect()->route('user.checkout.index')->with([
                'status' => 'danger',
                'message' => 'Terjadi kesalahan saat memproses data!'
            ]);
        }
    }
}
