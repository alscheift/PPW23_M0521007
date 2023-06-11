<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserPostController extends Controller
{
    public function show(User $user): View
    {
        return view('posts.index', [
            'posts' => $user->posts()->latest()->filter(request(['search', 'category', 'author']))
                ->paginate(6)->withQueryString() // simplePaginate(6) for simple version
        ]);
    }

    public function index(): View
    {
        return view('user.posts.index', [
            'posts' => auth()->user()->posts()->latest()->paginate(6)
        ]);
    }

    public function create(): View
    {
        return view('user.posts.create');
    }

    public function store():
    \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $attributes = $this->validatePost();

        $attributes['thumbnail'] ??= request()->file('thumbnail')?->store('thumbnails');
        $attributes['user_id'] = auth()->id();

        Post::create($attributes);

        return redirect('/');
    }

    public function edit(Post $post): View
    {
        return view('user.posts.edit', ['post' => $post]);
    }

    public function update(Post $post)
    {
        $attributes = $this->validatePost($post);

        if ($attributes['thumbnail'] ?? false) {
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }

        $post->update($attributes);

        return redirect('/posts/' . $post->slug)->with('success', 'Successfully updated post!');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect('/')->with('success', 'Successfully deleted post!');
    }

    /**
     * @param Post|null $post
     * @return array
     */
    public function validatePost(?Post $post = null): array
    {
        $post ??= new Post();
        return request()->validate([
            'title' => 'required',
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post)],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'thumbnail' => ['image']
        ]);
    }
}
