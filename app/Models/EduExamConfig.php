<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class EduExamConfig extends BaseModel
{
  
    protected $table = 'edu_exam_configs';
    protected $fillable = ['id', 'exam_overview', 'exam_duration', 'questions', 'total_question', 'per_question_mark', 'created_by'];

}
