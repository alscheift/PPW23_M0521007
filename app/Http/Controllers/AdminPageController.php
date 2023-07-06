<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    public function index()
    {
        $url = \request()->path();
        $segments = explode('/', $url);
        $items = [];

        // Get the value after "admin/"
        $var = $segments[1];

        if ($var == 'posts') {
            $items = Post::all();
        } elseif ($var == 'users') {
            $items = User::all();
        } elseif ($var == 'comments') {
            $items = Comment::all();
        }
        return view('admin.index', compact('items', 'var'));
    }
}
