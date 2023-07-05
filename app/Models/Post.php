<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method orderBy(mixed $column, string $string)
 * @method static create(array $attributes)
 */
class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['category', 'author'];

    public function scopeFilter($query, array $filters): void
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($query) {
                return $query->where('title', 'like', '%' . request('search') . '%')
                    ->orWhere('body', 'like', '%' . request('search') . '%');
            });
        });

        $query->when($filters['category'] ?? false, function ($query, $category) {
            return $query->whereHas(
                'category',
                fn($query) => $query->where('slug', $category)
            );
        });

        $query->when($filters['author'] ?? false, function ($query, $author) {
            return $query->whereHas(
                'author',
                fn($query) => $query->where('username', $author)
            );
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getImagePath(): string
    {
        $defaultUrl = 'https://picsum.photos/seed/' . $this->id . '/1100/860';
        $thumbnailUrl = 'storage/' . $this->thumbnail;

        if ($this->thumbnail && file_exists(public_path($thumbnailUrl)))
            return asset($thumbnailUrl);
        return $defaultUrl;
    }

    public function latest($column = 'created_at')
    {
        return $this->orderBy($column, 'desc');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getRawBody()
    {
        return $this->getRawOriginal('body');
    }

    protected function body(): Attribute
    {
        return Attribute::make(
            get: function (string $value) {
                $value = htmlspecialchars($value);
                $lines = explode(PHP_EOL, $value);
                $wrappedLines = array_map(function ($line) {
                    return '<p class="text-justify">' . trim($line) . '</p>';
                }, $lines);

                return implode('', $wrappedLines);
            }
        );
    }

    protected function slug(): Attribute
    {
        return Attribute::make(
            set: function (string $value) {
                $slug = str_replace(' ', '-', $value);
                $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);
                return strtolower($slug);
            }
        );
    }

    
}
