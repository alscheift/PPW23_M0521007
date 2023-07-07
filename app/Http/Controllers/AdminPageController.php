<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminPageController extends Controller
{
    public function index(): View|RedirectResponse
    {
        if (!(auth()->user()->can('admin')))
            return redirect()->back();

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

    public function destroy()
    {
        // if not admin
        if (!(auth()->user()->can('admin')))
            return redirect()->back();

        $url = \request()->path();
        $segments = explode('/', $url);
        $var = $segments[1] ?? 'index';
        $id = $segments[2] ?? null;
        if ($var == 'posts') {
            $post = Post::findOrFail($id);
            $post->delete();
            return redirect()->route('admin.index.posts')->with('success', 'Post deleted successfully');
        } elseif ($var == 'users') {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->route('admin.index.users')->with('success', 'User deleted successfully');
        } elseif ($var == 'comments') {
            $comment = Comment::findOrFail($id);
            $comment->delete();
            return redirect()->route('admin.index.comments')->with('success', 'Comment deleted successfully');
        }

        return redirect()->route('admin.index');
    }


}
