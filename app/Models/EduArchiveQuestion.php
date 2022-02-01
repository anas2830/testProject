<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class EduArchiveQuestion extends BaseModel
{

    protected $table = 'edu_archive_questions';
    protected $fillable = ['id', 'question', 'answer_type', 'created_by'];


}
