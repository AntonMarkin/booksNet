<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'text'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Change field "share" to the opposite value
     *
     * @param integer $bookId
     * @return boolean
     */
    static public function bookShare($bookId)
    {
        $book = Book::findOrFail($bookId);
        if ($book->share) {
            Book::where('id', $bookId)->update(['share' => false]);
            return false;
        } else {
            Book::where('id', $bookId)->update(['share' => true]);
            return true;
        }
    }

    /**
     * Delete book by id
     *
     * @param integer $bookId
     * @param integer $userId
     * @return Book
     */
    static public function deleteBook($bookId, $userId)
    {
        return Book::where('id', $bookId)->where('user_id', $userId)->delete();
    }
}
