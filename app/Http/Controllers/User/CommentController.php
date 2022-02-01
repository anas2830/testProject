<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use Helper;
use Validator;
use Str;
use Auth;
use File;
use Image;

use App\Models\UserBlog;
use App\Models\UserComments;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'comment' => ['required'],
        ]);

        $comment = $request->comment;
        $blog_id = $request->blog_id;
        $auth = Auth::guard('web')->user();

        if(!empty($auth)){

            UserComments::create([
                'blog_id' => $blog_id,
                'gen_user_id' => Auth::guard('web')->user()->id,
                'comment' => $comment,
                'status' => 1,
            ]);

            $output['messege'] = "Comment Submit successfully";
            $output['msgtype'] = 'success';

        }else{

            $output['messege'] = "Please at first login";
            $output['msgtype'] = 'danger';

        }



        return response()->json($output);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
