<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\Auth;

class Access extends Pivot
{
    use HasFactory;
    protected $table = 'accesses';

    protected $fillable = [
        'author_id',
        'user_id',

    ];
    //public $incrementing = true;
    static public function checkAccess($id, $author)
    {
        return Access::where('user_id', $id)
            ->where('author_id', $author)
            ->first();
    }
    static public function changeAccess($id, $author)
    {
        if(self::checkAccess($id, $author)->access){
            return Access::where('user_id', $id)
                ->where('author_id', $author)
                ->delete();
        } else {
            return Access::create([
                'author_id' => $author,
                'user_id' => $id
            ]);
        }
    }
}
