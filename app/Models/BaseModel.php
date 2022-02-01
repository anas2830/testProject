<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class BaseModel extends Model
{

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    //$type = 1 means Admin Control And 2 means Provider Control
    public static function adminBoot($type=0)
    {
        if(Auth::guard('admin')->check()) {
            $authId = Auth::guard('admin')->id();
            self::bootAction($authId);
        }
    }

    public static function ModeratorBoot($type=0)
    {
      
        if(Auth::guard('moderator')->check()) {
            $authId = Auth::guard('moderator')->id();
            self::bootAction($authId);
        } 
    
    }

    public static function userBoot($type=0)
    {
        if(Auth::check()) {
            $authId = Auth::id();
            self::bootAction($authId);
        }
    }

    public static function bootAction($authId)
    {
        parent::boot();

        static::creating(function($model) use ($authId)
        {
            $model->created_by = $authId;
            $model->valid = 1;
        });

        static::deleting(function($model) use ($authId)
        {
            $model->valid = 0;
            $model->update();
        });
    }
}
