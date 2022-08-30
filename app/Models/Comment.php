<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = ['post_id', 'user_id', 'comment'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i'
    ];

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
