<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminLoginController extends Controller
{
    function index()
    {

        return view('admin.login');
    }
    public function check(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'password' => 'required',

            ]
        );
        if ($validator->passes()) {
            if (Auth::guard('admin')->attempt([
                'email' => $request->email,
                'password' => $request->password,
            ], $request->get('remember')));
            return redirect()->route('dashboard.index');
        } else {
            return  redirect(route('admin.login'))->withErrors($validator)->withInput($request->only('email'));
        }
    }
}
