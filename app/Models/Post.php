<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id']; //guarded is the opposite of fillable

    protected $with = ['category', 'author']; // eager loading
    //fillable is what allowed to be mass assigned
    // Post::create([
    //     'title' => 'My First Post',
    //     'excerpt' => 'My First Post Excerpt',
    //     'body' => 'My First Post Body',
    // ]);
    /*
    in php artisan thinker

    Post::create([ 'title' => 'My First Post','excerpt' => 'My First Post Excerpt','body' => 'My First Post Body']);

    */

    /*
    protected $fillable = [
         'title',
         'excerpt',
         'body',
     ];*/

    public function scopeFilter($query, array $filters) // Post::newQuery()->filter()
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($query) {
                return $query->where('title', 'like', '%' . request('search') . '%')
                    ->orWhere('body', 'like', '%' . request('search') . '%');
            });
        });

        $query->when($filters['category'] ?? false, function ($query, $category) {
            return $query->whereHas('category', fn($query) => $query->where('slug', $category)
            );
        });

        $query->when($filters['author'] ?? false, function ($query, $author) {
            return $query->whereHas('author', fn($query) => $query->where('username', $author)
            );
        });
    }

    public function getRouteKeyName(): string
    {
        //return parent::getRouteKeyName();
        return 'slug';
    }

    public function latest($column = 'created_at')
    {
        return $this->orderBy($column, 'desc');
    }

    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        // hasOne, hasMany, belongsTo, belongsToMany (which one);
        return $this->belongsTo(Category::class);
        // access it as property, not function. $post->category;
    }

    public function author(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        // hasOne, hasMany, belongsTo, belongsToMany (which one);
        return $this->belongsTo(User::class, 'user_id');
        // access it as property, not function. $post->user;
    }
}
