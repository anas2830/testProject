<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class EduStudentExamQuestion extends BaseModel
{

    protected $table = 'edu_student_exam_questions';
    protected $fillable = ['id', 'student_exam_id', 'student_id', 'question_id', 'answer', 'answered', 'corrected', 'created_by'];


}
