<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

//    protected $guarded = []; // allow mass assignment
// or use Model::unguard() on AppServiceProvider, set it there
    public function post() // laravel will think that this is post_id nonetheless
    : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function author() // laravel will think that this is author_id if we don't specify
    : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
