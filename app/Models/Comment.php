<?php

namespace App\Models;

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
    static function getNotDeletedComments($profileId, $limit = null, $offset = null)
    {
        return Comment::where('profile_id', $profileId)
            ->where('status', '!=', 'deleted')
            ->limit($limit)
            ->offset($offset)
            ->get();
    }

    /**
     * Get comments by user id
     *
     * @param integer $userId
     * @return Comment
     */
    static function getUserComments($userId)
    {
        return Comment::where('user_id', $userId)->get();
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
