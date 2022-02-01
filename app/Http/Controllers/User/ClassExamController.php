<?php

namespace App\Http\Controllers\User;

use DB;
use Auth;
use Helper;
use DateTime;
use Validator;
use DateInterval;

use App\Models\EduArchiveQuestion;
use App\Models\EduAnswer;
use App\Models\EduStudentExamQuestion;
use App\Models\EduExamConfig;

use App\Models\EduStudentExam;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class ClassExamController extends Controller
{
    public function classExam(Request $request)
    {


        $authId = Auth::guard('web')->user()->id;
        $data['examConfig'] = $examConfig = EduExamConfig::first();


        if (!empty($examConfig)) {
      
                $examAlreadyGiven = EduStudentExam::where('exam_config_id', $examConfig->id)
                    ->where('student_id', $authId)
                    ->first();
    
                if (empty($examAlreadyGiven)) { //Exam Not Given
                    $data['examQuestions'] = $examQuestions = EduArchiveQuestion::whereIn('id', json_decode($examConfig->questions))->get();
                    foreach ($examQuestions as $key => $question) {
                        $question->answers = EduAnswer::where('question_id', $question->id)->get();
                    }
            
                    $exam_duration = ($examConfig->exam_duration>0) ? $examConfig->exam_duration : 0;
                    $data['total_exam_dur'] = $exam_duration * 60;
                    return view('website.class.classExam', $data);
    
                } else { //Exam Already Given
                    $output['messege'] = ' Exam is Already Given!!!';
                    $output['back_route'] = 'home';
                    return view('examError', $output);
                }
       
            
        } else {
            $output['messege'] = ' Exam is Not Configured!!!';
            $output['back_route'] = 'home';
            return view('examError', $output);
        }
    }

    public function classExamSubmit(Request $request)
    {
        $exam_config_id = $request->exam_config_id;
        
        if(isset($exam_config_id)) {
            $user_id = Auth::guard('web')->user()->id;
            $config_info = EduExamConfig::find($exam_config_id);

            $examArchQuestions = json_decode($config_info->questions);
            $given_qns_id = [];

            $examAlreadyGiven = EduStudentExam::where('exam_config_id', $exam_config_id)
                ->where('student_id', $user_id)
                ->first();

            if (empty($examAlreadyGiven)) { //Exam Not Given
                DB::beginTransaction();
                $config_duration = gmdate("H:i:s", $config_info->exam_duration * 60);
                $taken_duration = strtotime($request->current_time);
                $spend_exam_time =  strtotime($config_duration) - $taken_duration;
            
                // answer data
                $given_answer_array = $request->answer;
                $total_answered = count($given_answer_array);
                
                $studentExam = EduStudentExam::create([
                    "exam_config_id"        => $exam_config_id,
                    "student_id"            => $user_id,
                    "exam_duration"         => $config_info->exam_duration,
                    "total_questions"       => $config_info->total_question,
                    "per_question_mark"     => $config_info->per_question_mark,
                    "taken_duration"        => $spend_exam_time,
                    "total_answer"          => $total_answered,
                    "total_correct_answer"  => 0
                ]);

                $correct_answer = 0;
                foreach($given_answer_array as $q_id => $answer){
                    $given_qns_id[] = $q_id;
                    $question = EduArchiveQuestion::find($q_id);
                    if($question->answer_type==1) { //True/False
                        $answer_db = EduAnswer::where('question_id', $q_id)->first();
                        $answer_db = (!empty($answer_db)) ? [$answer_db->true_answer] : [];
                    } else { //Single/Multiple MCQ
                        $answer_db = EduAnswer::where('question_id', $q_id)->where('true_answer', 1)->get()->pluck('id')->all();
                    }
                    // Check the given ans correct or not
                    $corrected = (self::arrayEqualityCheck($answer, $answer_db))?1:0;

                    EduStudentExamQuestion::create([
                        "student_exam_id" => $studentExam->id,
                        'student_id'  =>  $user_id,
                        "question_id"     => $q_id,
                        "answer"          => serialize($answer),
                        "answered"        => 1,
                        "corrected"       => $corrected
                    ]);

                    $correct_answer += $corrected;
                    EduStudentExam::find($studentExam->id)->update(["total_correct_answer"=> $correct_answer]);
                }

                $notAnswered = array_diff($examArchQuestions, $given_qns_id);

                if (count($notAnswered) > 0) {
                    foreach ($notAnswered as $key => $question_id) {
                        EduStudentExamQuestion::create([
                            "student_exam_id" => $studentExam->id,
                            'student_id' => $user_id,
                            "question_id"     => $question_id,
                            "answer"          => '',
                            "answered"        => 0,
                            "corrected"       => 0
                        ]);
                    }
                }

                DB::commit();

                $output['messege'] = 'Your Exam has taken Succesfully!';
                $output['msgType'] = 'success';
            } else {
                $output['messege'] = 'Exam is Already Given!!!';
                $output['msgType'] = 'danger';
            }
        }else{
            $output['messege'] = 'Exam is not Configured!!!';
            $output['msgType'] = 'danger';
        }
        return response($output);
    }

    public static function arrayEqualityCheck($arrayA, $arrayB) {
        sort($arrayA);
        sort($arrayB);
        return $arrayA==$arrayB;
    }

    public function examResultShow(Request $request){


        $student_id = Auth::guard('web')->user()->id;

        $data['examConfig'] = $examConfig = EduExamConfig::first();

        if (!empty($examConfig)) {

            $examAlreadyGiven = EduStudentExam::where('student_id', $student_id)->first();

            if (!empty($examAlreadyGiven)) { //Exam Already Given

                $data['finalResult']  = EduStudentExam::where('student_id', $student_id)->first();

                $data['examQuestions'] = $examQuestions = EduStudentExamQuestion::join('edu_archive_questions', 'edu_archive_questions.id', '=', 'edu_student_exam_questions.question_id')
                    ->select('edu_student_exam_questions.*', 'edu_archive_questions.question', 'edu_archive_questions.answer_type')
                    ->whereIn('edu_student_exam_questions.question_id', json_decode($examConfig->questions))
                    ->where('edu_student_exam_questions.student_exam_id', $examAlreadyGiven->id)
                    ->get();
                foreach ($examQuestions as $key => $question) {
                    $question->answerSet = EduAnswer::where('question_id', $question->question_id)->get();
                }
                
                return view('website.class.examResult', $data);
            } 
        }
    }
}
