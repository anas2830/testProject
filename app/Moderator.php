<?php

    namespace App;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;

    class Moderator extends Authenticatable
    {
        use Notifiable;

        protected $guard = 'moderator';

        protected $fillable = [
            'name', 'email', 'password', 'photo_name', 'photo_original_name', 'photo_size', 'photo_extention',
        ];

        protected $hidden = [
            'password', 'remember_token',
        ];
    }