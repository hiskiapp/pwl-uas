<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Plan;
use App\Models\Transaction;
use App\Models\Whatsapp;
use Facades\Services\TripayService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('user.transactions.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function show($code)
    {
        $transaction = Transaction::with(['user', 'paymentMethod', 'transactionItems' => function($q){
            $q->with('product');
        }])->where([
            'user_id' => auth()->id(),
            'code' => $code
        ])->firstOrFail();

        return view('user.transactions.show', compact('transaction'));
    }
}
