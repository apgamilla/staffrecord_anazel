<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }
    public function storeUser(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'role_name' => 'required|string|max:255',
            'password'  => 'required|string|min:8|confirmed',
            'phone_number'  => 'required',
            'password_confirmation' => 'required',
        ]);

        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'role_name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'password' => ['required', 'confirmed', Password::min(8)
        //             ->mixedCase()
        //             ->letters()
        //             ->numbers()
        //             ->symbols()
        //             ->uncompromised(),
        //     'password_confirmation' => 'required',
        //     ],
        // ]);
        
        User::create([
            'name'      => $request->name,
            'avatar'    => $request->image,
            'email'     => $request->email,
            'phone_number'     => $request->phone_number,
            'role_name' => $request->role_name,
            'status' => "Active",
            'password'  => Hash::make($request->password),
        ]);
        Toastr::success('Create new account successfully :)','Success');
        return redirect('login');
    }
}
