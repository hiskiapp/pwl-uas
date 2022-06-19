<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
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
        $transaction = Transaction::with(['user', 'paymentMethod', 'transactionItems' => function($q){
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
        Transaction::find($id)->update(['status' => 'Waiting Payment', 'updated_at' => now()]);

        return response()->json(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function shipping($id): \Illuminate\Http\JsonResponse
    {
        Transaction::find($id)->update(['status' => 'Shipping', 'updated_at' => now()]);

        return response()->json(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function done($id): \Illuminate\Http\JsonResponse
    {
        Transaction::find($id)->update(['status' => 'Done', 'updated_at' => now()]);

        return response()->json(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function failed($id): \Illuminate\Http\JsonResponse
    {
        Transaction::find($id)->update(['status' => 'Failed', 'updated_at' => now()]);

        return response()->json(true);
    }
}
