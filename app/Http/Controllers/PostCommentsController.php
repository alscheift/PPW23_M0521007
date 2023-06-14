<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PostCommentsController extends Controller
{
    public function store(Post $post): RedirectResponse
    {
        $request = request()->validate([
            'body' => ['required', 'max:255']
        ]);

        $post->comments()->create([
            'user_id' => auth()->id(),
            'body' => $request['body']
        ]);

        return back();
    }
}
