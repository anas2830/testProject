<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class UserBlog extends BaseModel
{
    use SoftDeletes;

    protected $table = 'user_blogs';

    protected $fillable = ['id', 'gen_user_id','blog_title', 'blog_description', 'photo_name', 'photo_original_name', 'photo_size', 'photo_extention', 'valid'];

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
