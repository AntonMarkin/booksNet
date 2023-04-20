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
    static public function getUserBooks($userId)
    {
        return Book::where('user_id', $userId)->get();
    }
    static public function bookShare($bookId)
    {
        $book = Book::findOrFail($bookId);
        if($book->share){
            return Book::where('id', $bookId)->update(['share' => false]);
        } else {
            return Book::where('id', $bookId)->update(['share' => true]);
        }
    }
}
