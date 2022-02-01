<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;



class EduAnswer extends BaseModel
{

    protected $table = 'edu_answers';
    protected $fillable = ['id', 'question_id', 'answer', 'true_answer', 'created_by'];

}
