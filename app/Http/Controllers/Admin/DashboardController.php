<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $totalIncome = Transaction::query()->where('status', 'Done')->get()->sum(function ($transaction) {
            return $transaction->total_price - $transaction->shipping_cost;
        });
        $totalUsers = User::query()->count();

        return view('admin.dashboard.index', compact('totalIncome', 'totalUsers'));
    }
}
