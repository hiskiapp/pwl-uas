<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Transaction;
use Exception;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Admin;
use App\Models\User;
use App\Models\Setting;

class DataController extends Controller
{
    /**
     * @throws Exception
     */
    public function transactions()
    {
        $transactions = Transaction::with(['user', 'paymentMethod'])->get();

        return DataTables::of($transactions)
            ->editColumn('created_at', function ($transaction) {
                return $transaction->created_at ? with(new Carbon($transaction->created_at))->format('d F Y H:i') : '';
            })
            ->addIndexColumn()
            ->make();
    }
    /**
     * @throws Exception
     */
    public function admins()
    {
        $admins = Admin::select('name', 'email', 'updated_at', 'id')
        ->get();

        return DataTables::of($admins)
        ->editColumn('updated_at', function ($admin) {
            return $admin->updated_at ? with(new Carbon($admin->updated_at))->format('d F Y H:i') : '';
        })
        ->addIndexColumn()
        ->make();
    }

    /**
     * @throws Exception
     */
    public function users()
    {
        $users = User::orderBy('created_at', 'desc')->get();

        return DataTables::of($users)
        ->editColumn('created_at', function ($user) {
            return $user->created_at ? with(new Carbon($user->created_at))->format('d F Y H:i') : '';
        })
        ->addIndexColumn()
        ->make();
    }

    /**
     * @throws Exception
     */
    public function categories()
    {
        $categories = Category::withCount('products')->get();

        return DataTables::of($categories)
            ->editColumn('updated_at', function ($setting) {
                return $setting->updated_at ? with(new Carbon($setting->updated_at))->format('d F Y H:i') : '';
            })
            ->addIndexColumn()
            ->make();
    }

    /**
     * @throws Exception
     */
    public function products()
    {
        $products = Product::with(['category' => function ($query) {
            $query->select('id', 'name');
        }]);

        return DataTables::of($products)
            ->editColumn('updated_at', function ($setting) {
                return $setting->updated_at ? with(new Carbon($setting->updated_at))->format('d F Y H:i') : '';
            })
            ->addIndexColumn()
            ->make();
    }

    /**
     * @throws Exception
     */
    public function paymentMethods()
    {
        $paymentMethods = PaymentMethod::all();

        return DataTables::of($paymentMethods)
            ->editColumn('updated_at', function ($setting) {
                return $setting->updated_at ? with(new Carbon($setting->updated_at))->format('d F Y H:i') : '';
            })
            ->addIndexColumn()
            ->make();
    }

    /**
     * @throws Exception
     */
    public function settings()
    {
        $settings = Setting::all();

        return DataTables::of($settings)
        ->editColumn('updated_at', function ($setting) {
            return $setting->updated_at ? with(new Carbon($setting->updated_at))->format('d F Y H:i') : '';
        })
        ->addIndexColumn()
        ->make();
    }
}
