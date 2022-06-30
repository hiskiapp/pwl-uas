<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.transactions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $transaction = Transaction::with(['user', 'paymentMethod', 'city', 'province', 'transactionItems' => function ($q) {
            $q->with('product');
        }])->findOrFail($id);

        return view('admin.transactions.show', compact('transaction'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function waiting($id): \Illuminate\Http\JsonResponse
    {
        $transaction = Transaction::find($id);
        self::addStocks($transaction);
        $transaction->update(['status' => 'Waiting Payment', 'updated_at' => now()]);

        return response()->json(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function shipping($id): \Illuminate\Http\JsonResponse
    {
        $transaction = Transaction::find($id);
        self::subStocks($transaction);
        $transaction->update(['status' => 'Shipping', 'updated_at' => now()]);

        return response()->json(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function done($id): \Illuminate\Http\JsonResponse
    {
        $transaction = Transaction::find($id);
        self::subStocks($transaction);
        $transaction->update(['status' => 'Done', 'updated_at' => now()]);

        return response()->json(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function failed($id): \Illuminate\Http\JsonResponse
    {
        $transaction = Transaction::find($id);
        self::addStocks($transaction);
        $transaction->update(['status' => 'Failed', 'updated_at' => now()]);

        return response()->json(true);
    }

    private static function subStocks(Transaction $transaction): void
    {
        if (in_array($transaction->status, ['Waiting Payment', 'Failed'])) {
            $items = TransactionItem::query()->where('transaction_id', $transaction->id)->get();
            foreach ($items as $item) {
                $product = Product::find($item->product_id);
                $product->stock -= $item->quantity;
                $product->save();
            }
        }
    }

    private static function addStocks(Transaction $transaction): void
    {
        if (in_array($transaction->status, ['Shipping', 'Done'])) {
            $items = TransactionItem::query()->where('transaction_id', $transaction->id)->get();
            foreach ($items as $item) {
                $product = Product::find($item->product_id);
                $product->stock += $item->quantity;
                $product->save();
            }
        }
    }
}
