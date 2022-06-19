<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PaymentMethodRequest;
use App\Models\PaymentMethod;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Services\FileService;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.payment-methods.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.payment-methods.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PaymentMethodRequest $request
     * @return RedirectResponse
     */
    public function store(PaymentMethodRequest $request): RedirectResponse
    {
        PaymentMethod::create([
            'icon' => (new FileService)->upload($request->icon, 'payment-methods'),
            'name' => $request->name,
            'account_number' => $request->account_number,
            'account_owner' => $request->account_owner,
        ]);

        return redirect()->route('admin.payment-methods.index')->with([
            'status' => 'success',
            'message' => 'Data payment method berhasil ditambahkan!'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);

        return view('admin.payment-methods.edit', compact('paymentMethod'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PaymentMethodRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(PaymentMethodRequest $request, $id): RedirectResponse
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        $paymentMethod->update([
            'icon' => $request->icon ? (new FileService)->upload($request->icon, 'payment-methods') : $paymentMethod->icon,
            'name' => $request->name,
            'account_number' => $request->account_number,
            'account_owner' => $request->account_owner,
        ]);

        return redirect()->route('admin.payment-methods.index')->with([
            'status' => 'success',
            'message' => 'Data payment method berhasil diubah!'
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
        PaymentMethod::findOrFail($id)->delete();

        return response()->json(true);
    }
}
