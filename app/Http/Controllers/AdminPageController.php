<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminPageController extends Controller
{
    public function index(): View
    {
        $url = \request()->path();
        $segments = explode('/', $url);
        $items = [];

        // Get the value after "admin/"
        $var = $segments[1] ?? 'index';

        if ($var == 'posts') {
            $items = Post::all();
            // sort by date
            $items = $items->sortByDesc('created_at');

        } elseif ($var == 'users') {
            $items = User::all();

        } elseif ($var == 'comments') {
            $items = Comment::all();
        } else {
            $items = [
                'userCount' => User::count(),
                'postCount' => Post::count(),
                'commentCount' => Comment::count()
            ];
        }
        return view('admin.index', compact('items', 'var'));
    }
}
