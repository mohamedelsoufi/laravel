<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{
    public function adult()
    {
        return view('customAuth.index');
    }

    public function admin()
    {
        return view('admin.index');
    }

    public function user()
    {
        return view('front.index');
    }

    public function login()
    {
        return view('admin.login');
    }

    public function Checklogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended('admin/admin');

        }
        return back()->withInput($request->only('email'));
    }
}
