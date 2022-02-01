<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Helper;
use File;
use DB;

use App\Models\EduArchiveQuestion;
use App\Models\EduAnswer;
use App\Models\EduStudentExamQuestion;

class ArchiveQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $data['activeMenu'] = "questions";
        $data['all_quizes'] = $all_quizes = EduArchiveQuestion::latest()->get();

        return view('super-admin.archiveQuestion.listData', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data['activeMenu'] = "questions";
        $data['answer_types'] = DB::table('edu_answer_types')->get();
        return view('super-admin.archiveQuestion.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $answer_type = $request->answer_type;
        $answer = ($answer_type==1) ? $request->answer_tf : $request->answer;
        $true_answer = $request->true_answer;

        $validator = Validator::make($request->all(), [
            'question'    => 'required',
            'answer_type' => 'required'
        ]);

        if ($validator->passes()) {

            $valid = true;
            if($answer_type > 1) { //1 = True/False
                $emptyAnswer = true;
                if(!empty($answer)) {
                    foreach ($answer as $ans) {
                        if(!empty($ans)) {
                            $emptyAnswer = false;
                            break;
                        }
                    }
                }
                if($emptyAnswer) { 
                    $valid = false;
                    $errMessage = "Enter at least one answer";
                }

                if($valid) {
                    if(empty($true_answer)) { 
                        $valid = false;
                        $errMessage = "Enter at least one correct answer";
                    } else {
                        $emptyCorrectAnswer = true;
                        foreach ($true_answer as $true_ans) {
                            if(!empty($answer[$true_ans])) {
                                $emptyCorrectAnswer = false;
                                break;
                            }
                        }
                        if($emptyCorrectAnswer) { 
                            $valid = false;
                            $errMessage = "Enter at least one correct answer";
                        }
                    }
                }
            }

            DB::beginTransaction();
            if ($valid) {
                $inputData = [
                    'question' => $request->question,
                    'answer_type' => $request->answer_type
                ];
                $question_table = EduArchiveQuestion::create($inputData);
                $question_id = $question_table->id;

                if($answer_type == 1) {  //1 = True/False
                    EduAnswer::create([
                        "answer" => (!empty($answer[0]))?"True":"False",
                        "true_answer" => (!empty($answer[0]))?1:0,
                        "question_id" => $question_id
                    ]);
                } else { //2/3 = Signle/Multiple
                    foreach ($answer as $index=>$ans) {
                        if(!empty($ans)) {
                            EduAnswer::create([
                                "answer" => $ans,
                                "true_answer" => (in_array($index, $true_answer))?1:0,
                                "question_id" => $question_id
                            ]);
                        }
                    }
                }
                $output['messege'] = 'Question has been Archived';
                $output['msgType'] = 'success';
            } else {
                $output['messege'] = $errMessage;
                $output['msgType'] = 'danger';
            }
            DB::commit();
            return redirect()->back()->with($output);
        } else {
            return redirect()->back()->withErrors($validator);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['activeMenu'] = "questions";
        $data['question'] = EduArchiveQuestion::find($id);
        $data['answer'] = EduAnswer::where("question_id", $id)->orderBy("id", "asc")->get();
        $data['answerType'] = DB::table("edu_answer_types")->orderBy("id", "asc")->get();

        return view('super-admin.archiveQuestion.update', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $answer_type = $request->answer_type;
        $answer = ($answer_type==1) ? $request->answer_tf : $request->answer;
        $answer_id = $request->answer_id;
        $answer_id = (!empty($answer_id)) ? $answer_id : [];
        $true_answer = $request->true_answer;
        
        $validator = Validator::make($request->all(), [
            'question'    => 'required',
            'answer_type' => 'required'
        ]);

        if ($validator->passes()) {

            

   
                $valid = true;
                if($answer_type > 1) { //1 = True/False
                    $emptyAnswer = true;
                    if(!empty($answer)) {
                        foreach ($answer as $ans) {
                            if(!empty($ans)) {
                                $emptyAnswer = false;
                                break;
                            }
                        }
                    }
                    if($emptyAnswer) { 
                        $valid = false;
                        $errMessage = "Enter at least one answer";
                    }
    
                    if($valid) {
                        if(empty($true_answer)) { 
                            $valid = false;
                            $errMessage = "Enter at least one correct answer";
                        } else {
                            $emptyCorrectAnswer = true;
                            foreach ($true_answer as $true_ans) {
                                if(!empty($answer[$true_ans])) {
                                    $emptyCorrectAnswer = false;
                                    break;
                                }
                            }
                            if($emptyCorrectAnswer) { 
                                $valid = false;
                                $errMessage = "Enter at least one correct answer";
                            }
                        }
                    }
                }
    
                DB::beginTransaction();
                if ($valid) {
                    $inputData = [
                        'question' => $request->question,
                        'answer_type' => $request->answer_type
                    ];
    
                    $questionDB = EduArchiveQuestion::find($id);
                    $answerDB = EduAnswer::where("question_id", $id)->get();
                    
                    EduArchiveQuestion::find($id)->update($inputData);
    
                    if($answer_type==1) {
                        $answerInput = [
                            "answer" => (!empty($answer[0]))?"True":"False",
                            "true_answer" => (!empty($answer[0]))?1:0,
                            "question_id" => $id
                        ];
    
                        if($questionDB->answer_type==1) {
                            if(empty($answerDB)) {
                                EduAnswer::create($answerInput);
                            } else {
                                EduAnswer::find($answerDB[0]->id)->update($answerInput);
                            }
                        } else {
                            foreach($answerDB as $ans) {
                                EduAnswer::find($ans->id)->delete();
                            }
                            EduAnswer::create($answerInput);
                        }
                    } else {
                        if($questionDB->answer_type==1) {
                            foreach ($answerDB as $ans) {
                                EduAnswer::find($ans->id)->delete();
                            }
                            foreach ($answer as $index=>$ans) {
                                if(!empty($ans)) {
                                    EduAnswer::create([
                                        "answer" => $ans,
                                        "true_answer" => (in_array($index, $true_answer))?1:0,
                                        "question_id" => $id
                                    ]);
                                }
                            }
                        } else {
                            $answer_id_db = collect($answerDB->pluck('id'));
                            $answer_diff = $answer_id_db->diff($answer_id);
    
                            if(!empty($answer_diff)) {
                                $answer_ac = EduAnswer::whereIn('id', $answer_diff)->get();
                                foreach($answer_ac as $ans_ac) {
                                    EduAnswer::find($ans_ac->id)->delete();
                                }
                            }
    
                            if(!empty($answer)) {
                                foreach ($answer as $index=>$ans) {
                                    $answerInput = [
                                        "answer" => $ans,
                                        "true_answer" => (in_array($index, $true_answer))?1:0,
                                        "question_id" => $id
                                    ];
    
                                    if($answer_id[$index]>0) {
                                        if(empty($ans)) {
                                            EduAnswer::find($answer_id[$index])->delete();
                                        } else {
                                            if($answer_id_db->contains($answer_id[$index])) {
                                                EduAnswer::find($answer_id[$index])->update($answerInput);
                                            } else {
                                                EduAnswer::create($answerInput);
                                            }
                                        }
                                    } else {
                                        if(!empty($ans)) {
                                            EduAnswer::create($answerInput);
                                        }
                                    }
                                }
                            }
                        }
                    }
    
                    $output['messege'] = 'Question has been Updated';
                    $output['msgType'] = 'success';
                } else {
                    $output['messege'] = $errMessage;
                    $output['msgType'] = 'danger';
                }
                DB::commit();
                return redirect()->back()->with($output);
     

        } else {
            return redirect()->back()->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $check_student_exam_questions = EduStudentExamQuestion::where('question_id',$id)->first();
        if (empty($check_student_exam_questions)) {
            DB::beginTransaction();
            $answer = EduAnswer::where("question_id", $id)->get();
            foreach ($answer as $answer) {
                EduAnswer::find($answer->id)->delete();
            }
            EduArchiveQuestion::find($id)->delete();
            DB::commit();
        } else {
            return "You Can't Delete Archive Question";
        }
        
    }
}
