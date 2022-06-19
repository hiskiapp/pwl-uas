<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.login.index');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 401);
        }

        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(!Auth::guard('admin')->attempt($data)) {
            return response()->json(['status' => 'failed'], 401);
        }

        return response()->json(['status' => 'success'], 200);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect(url('/'));
    }
}
