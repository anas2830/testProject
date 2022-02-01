<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use Helper;
use Validator;
use DB;
use Auth;



use App\Models\EduArchiveQuestion;
use App\Models\EduAnswer;
use App\Models\EduStudentExamQuestion;

use App\Models\EduExamConfig;
use App\Models\EduStudentExam;



class ClassExamController extends Controller
{

    public function examConfig(Request $request)
    {
        $data['activeMenu'] = "classExamConfig";

   
        $data['questions'] = EduArchiveQuestion::get();
            
        $data['examConfig'] = EduExamConfig::first();

        return view('super-admin.classExam.examConfig', $data);
    }

    public function saveExamConfig(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'exam_overview'     => 'required',
            'exam_duration'     => 'required',
            'per_question_mark' => 'required'
        ]);

        if ($validator->passes()) {
            $question = $request->question_id;
            if (isset($request->question_id)) {
                $total_question = count($question);
    
                if($total_question == 0){
                    $output['messege'] =  "Please at least select one question";
                    $output['msgType'] = 'danger';
                } else {
    
                    $existExamConfig = EduExamConfig::first();
                    if (!empty($existExamConfig)) {
                        
                        $check_student_given_exam = EduStudentExamQuestion::first();
                        if(empty($check_student_given_exam)){
                            $existExamConfig->update([
                                'exam_overview'     => $request->exam_overview,
                                'exam_duration'     => $request->exam_duration,
                                'questions'         => json_encode($question),
                                'total_question'    => $total_question,
                                'per_question_mark' => $request->per_question_mark
                            ]);
    
                            $output['messege'] =  "Exam configuration successfull";
                            $output['msgType'] = 'success';
    
                        }else{
                            $output['messege'] =  "Student Already given this exam";
                            $output['msgType'] = 'danger';
                        }
                    } else {
                        EduExamConfig::create([
                            'exam_overview'         => $request->exam_overview,
                            'exam_duration'         => $request->exam_duration,
                            'questions'             => json_encode($question),
                            'total_question'        => $total_question,
                            'per_question_mark'     => $request->per_question_mark
                        ]);
    
                        $output['messege'] =  "Exam configuration successfull";
                        $output['msgType'] = 'success';
                    }
                   
                }
            } else {
                $output['messege'] =  "Please at least select one question";
                $output['msgType'] = 'danger';
            }
            return redirect()->back()->with($output);
        } else {
            return redirect()->back()->withErrors($validator);
        }
    }

}
