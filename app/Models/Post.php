<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('published', function (Builder $builder) {
            $builder->wherePublished(1);
        });
    }

    /**
     * @var string[]
     */
    protected $fillable = ['user_id', 'title', 'description', 'published', 'image'];

    /**
     * @var string[]
     */
    protected $casts = [
      'created_at' => 'datetime:Y-m-d H:i'
    ];

    /**
     * Scope a query to only get active user posts.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopeActiveUserPosts($query)
    {
        $query->where('user_id', Auth::id());
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
