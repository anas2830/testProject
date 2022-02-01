<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class UserComments extends BaseModel
{
    use SoftDeletes;

    protected $table = 'user_comments';

    protected $fillable = ['id', 'blog_id', 'gen_user_id','comment', 'status', 'valid'];

    public static function boot()
    {
        parent::userBoot();
    }

    public function scopeValid($query)
    {
        $authId = Auth::id();
        return $query->where('valid', 1);
    }
}
