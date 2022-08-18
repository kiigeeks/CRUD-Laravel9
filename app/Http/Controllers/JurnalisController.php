<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;

class JurnalisController extends Controller
{
    public function index()
    {
        return view('jurnalis', [
            'title' => 'Portal Berita',
            'headerPage' => '',
            'Navcategories' => Category::all(),
            'jurnalis' => User::latest()->get()
        ]);
    }
}
