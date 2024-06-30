<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index() {
        return view ('register.index', [
            'title' => 'Register'
        ]);
    }

    public function store (Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:255',
            'username' => 'required|max:255|unique:users',
            'email' => 'required|email:dns|max:255|unique:users',
            'password' => 'required|min:5|max:255',
        ]);
        
        // $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        // session()->flash('success', 'Registration has been successfully! ');

        return redirect('/auth')->with('success', 'Registration has been successfully! ');
    }
}