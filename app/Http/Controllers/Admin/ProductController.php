<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Services\FileService;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductRequest $request
     * @return RedirectResponse
     */
    public function store(ProductRequest $request): RedirectResponse
    {
        Product::create([
            'photo' => (new FileService)->upload($request->file('photo'), 'products'),
            'slug' => Str::slug($request->name),
            'name' => $request->name,
            'description' => $request->description,
            'weight' => $request->weight,
            'stock' => $request->stock,
            'price' => $request->price,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('admin.products.index')->with([
            'status' => 'success',
            'message' => 'Data produk berhasil ditambahkan!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        $product = Product::with('category')->findOrFail($id);

        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $product = Product::with('category')->findOrFail($id);
        $categories = Category::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(ProductRequest $request, int $id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        $product->update([
            'photo' => $request->hasFile('photo') ? (new FileService)->upload($request->file('photo'), 'products') : $product->photo,
            'slug' => Str::slug($request->name),
            'name' => $request->name,
            'description' => $request->description,
            'weight' => $request->weight,
            'stock' => $request->stock,
            'price' => $request->price,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('admin.products.index')->with([
            'status' => 'success',
            'message' => 'Data produk berhasil diubah!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        Product::findOrFail($id)->delete();

        return response()->json(true);
    }
}
