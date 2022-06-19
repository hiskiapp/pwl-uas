<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;
use App\Models\Admin;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.admins.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AdminRequest $request
     * @return RedirectResponse
     */
    public function store(AdminRequest $request): RedirectResponse
    {
        Admin::create($request->validated());

        return redirect()->route('admin.admins.index')->with([
            'status' => 'success',
            'message' => 'Data admin berhasil ditambahkan!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        $admin = Admin::findOrFail($id);

        return view('admin.admins.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $admin = Admin::findOrFail($id);

        return view('admin.admins.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AdminRequest $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(AdminRequest $request, int $id): RedirectResponse
    {
        $admin = Admin::findOrFail($id);

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => is_null($request->password) ? $admin->password : $request->password
        ]);

        return redirect()->route('admin.admins.index')->with([
            'status' => 'success',
            'message' => 'Data admin berhasil diedit!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        Admin::findOrFail($id)->delete();

        return response()->json(true);
    }
}
