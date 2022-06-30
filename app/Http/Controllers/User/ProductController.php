<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        ++$product->seen_total;
        $product->save();

        return view('user.products.show', compact('product'));
    }
}
