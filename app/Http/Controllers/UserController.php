<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function login(Request $request) {
        $Formfileds = $request -> validate([
            'loginname' => 'required',
            'loginpassword' => 'required'
        ]);

        if (auth() -> attempt(['name' => $Formfileds['loginname'], 'password' => $Formfileds['loginpassword']])) {
            $request -> session()->regenerate();
        }
        return redirect('/');

    }

    public function logout() {
        auth()->logout();
        return redirect("/");
    }

    public function register(Request $request) {
        $EntradasFields = $request->validate([
            "email" => ["required", "email", Rule::unique('users', 'email')  ],
            "password" => ["required", "min:8", "max:200",],
            "name" => ["required", 'min:3', 'max:10', Rule::unique('users', 'name')]   
        ]);
        $EntradasFields['password'] = bcrypt($EntradasFields['password']);
        $user = User::create($EntradasFields);
        auth()->login($user);
        return redirect('/');
    }
 }
