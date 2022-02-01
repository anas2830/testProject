<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class EduStudentExam extends BaseModel
{

    protected $table = 'edu_student_exams';
    protected $fillable = ['id','exam_config_id', 'student_id', 'exam_duration', 'taken_duration', 'total_questions','total_answer','total_correct_answer','per_question_mark', 'created_by'];


}
