<?php

namespace App\Models;

use App\Scopes\CommentScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'profile_id',
        'user_id',
        'comment_id',
        'header',
        'text'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new CommentScope());
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Finds comment with the status unequal deleted by id and change status to deleted
     *
     * @param integer $id
     * @return Comment
     */
    static public function deletion($comment)
    {
        return $comment->update(['status' => 'deleted']);
    }
}
