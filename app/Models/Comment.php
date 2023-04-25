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
     * Get all comments with the status unequal deleted and with the specified parameters limit and offset
     *
     * @param integer $profileId
     * @param integer $limit
     * @param integer $offset
     * @return Comment
     */
    static function getProfileComments($profileId, $limit = null, $offset = null)
    {
        return Comment::where('profile_id', $profileId)
            ->limit($limit)
            ->offset($offset)
            ->get();
    }

    /**
     * Finds comment with the status unequal deleted by id and change status to deleted
     *
     * @param integer $id
     * @return Comment
     */
    static function deleteComment($id)
    {
        return Comment::where('id', $id)->where('status', '!=', 'deleted')->update(['status' => 'deleted']);
    }
}
