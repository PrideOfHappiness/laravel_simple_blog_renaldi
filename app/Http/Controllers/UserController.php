<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        // $data = Post::count();
        $data = Post::paginate(10);
        // dd($data);
        return view('home', compact('data'));
    }
}
