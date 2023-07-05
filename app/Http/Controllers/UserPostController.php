<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserPostController extends Controller
{
    public function show(User $user): View
    {
        $userPosts = $user->posts()->latest()->filter(request(['search', 'category', 'author']))
            ->paginate(6)->withQueryString();

        return view(
            'posts.index',
            compact('userPosts', 'user'));
    }

    public function index(): View
    {
        return view('user.posts.index', [
            'posts' => auth()->user()->posts()->latest()->paginate(6)
        ]);
    }

    public function create(): View
    {
        $categories = Category::all();

        return view(
            'user.posts.create',
            compact('categories')
        );
    }

    public function store(): RedirectResponse
    {
        $attributes = $this->validatePost();

        if (request()->file('thumbnail')) {
            $attributes['thumbnail'] = request()->file('thumbnail')?->store('thumbnails');
        }

        $attributes['user_id'] = auth()->id();

        Post::create($attributes);

        return redirect('/');
    }

    public function edit(Post $post): View
    {
        $categories = Category::all();
        return view(
            'user.posts.edit',
            compact('post', 'categories')
        );
    }

    public function update(Post $post): RedirectResponse
    {
        $attributes = $this->validatePost($post);

        if ($attributes['thumbnail'] ?? false) {
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }

        $post->update($attributes);

        return redirect('/posts/' . $post->slug)->with('success', 'Successfully updated post!');
    }

    public function destroy(Post $post): RedirectResponse
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
