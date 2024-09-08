<?php

namespace App\Http\Controllers;

use App\Models\User;
use cache;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function registration(Request $request)
    {
        try {
            $request->validate([
                'firstName' => 'required',
                'lastName' => 'required',
                'email' => 'required|email|min:10|unique:users',
                'password' => 'required|min:3|max:5',
            ]);
            // dd($request);
            $firstName = $request->firstName;
            $lastName = $request->lastName;
            $email = $request->email;
            $password = $request->password;
            User::create([
                'firstName' => $firstName,
                'lastName' => $lastName,
                'email' => $email,
                'password' => $password,
            ]);
            // dd($request);
            // dd($firstName);
            return redirect()->route('login');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email|min:10',
                'password' => 'required|min:3|max:5'
            ]);
            $email = $request->email;
            $password = $request->password;
            $user = User::where('email', $email)->where('password', $password)->first();
            if ($user) {
                return 'Authentic';
            } else {
                return 'Email and password does not exist';
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
