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

    /**
     * Return record from accesses table by $id and $authorId
     *
     * @param integer $id
     * @param integer $authorId
     * @return Access
     */
    static public function checkAccess($id, $authorId)
    {
        return Access::where('user_id', $id)
            ->where('author_id', $authorId)
            ->first();
    }

    /**
     * Change user access to author library
     *
     * @param integer $id
     * @param integer $authorId
     * @return boolean
     */
    static public function changeAccess($id, $authorId)
    {
        if (isset(self::checkAccess($id, $authorId)->access)) {
            Access::where('user_id', $id)
                ->where('author_id', $authorId)
                ->delete();
            return false;
        } else {
            Access::create([
                'author_id' => $authorId,
                'user_id' => $id
            ]);
            return true;
        }
    }
}
