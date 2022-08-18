<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SignupController extends Controller
{
    public function index()
    {
        return view('signup.index', [
            'title' => 'Portal Berita',
            'headerPage' => 'Sign Up',
            'Navcategories' => Category::all()
        ]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|unique:users|min:3|max:255',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255'
        ]);

        $validateData['password'] = Hash::make($validateData['password']);

        $result = User::create($validateData);

        if($result){
            return redirect('/signin')->with('regis_sukses', 'Registration successful!, Please Sign In!');
        } else {
            return back()->with('regis_error', 'Registration Error!');
        }
    }
}
