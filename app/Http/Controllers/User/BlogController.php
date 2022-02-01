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

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        return view('website.blog.create', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
        $data = [];
        return view('website.blog.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'         => 'required',
            'description'   => 'required',
            'blogImage'   => 'required',
        ]);

        if ($validator->passes()) {

            $title = $request->title;
            $description = $request->description;
            $photoFile = $request->blogImage;
            
            $photo_name = Null;
            $photo_original_name = Null;
            $photo_size = Null;
            $photo_extention = Null;

            if(isset($photoFile)){
                // $customPath = 'uploads/blog/'.Auth::guard('web')->user()->id;
                // if( is_dir($customPath) === false ){
                //     mkdir('uploads/blog/'.Auth::guard('web')->user()->id);
                //     mkdir('uploads/blog/'.Auth::guard('web')->user()->id.'/thumb');
                // }

                $validPath = 'uploads/blog/';

                $uploadResponse = Helper::getUploadedFileName($photoFile, $validPath);
                if($uploadResponse['status'] == 1){
                    $photo_name = $uploadResponse['file_name'];
                    $photo_original_name = $uploadResponse['file_original_name'];
                    $photo_size = $uploadResponse['file_size'];
                    $photo_extention = $uploadResponse['file_extention'];
                }else{
                    $output['messege'] = $uploadResponse['errors'];
                    $output['msgType'] = 'danger';
                    return redirect()->back()->with($output);
                } 
            }

            UserBlog::create([
                'gen_user_id' => Auth::guard('web')->user()->id,
                'blog_title' => $title,
                'blog_description' => $description,
                'photo_name' => $photo_name,
                'photo_original_name' => $photo_original_name,
                'photo_size' => $photo_size,
                'photo_extention' => $photo_extention,
            ]);

            $output['messege'] = 'Blog has been Created';
            $output['msgType'] = 'success';
        
            return redirect()->back()->with($output);
        }else{
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['blog'] = UserBlog::valid()->find($id);
        return view('website.blog.update', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title'         => 'required',
            'description'   => 'required',
        ]);

        if ($validator->passes()) {
            $blog = UserBlog::valid()->find($id);
            $title = $request->title;
            $description = $request->description;
            $photoFile = $request->blogImage;

            if(isset($photoFile)){

                // $customPath = 'uploads/blog/'.$id;
                // if( is_dir($customPath) === false ){
                //     mkdir('uploads/blog/'.$id);
                //     mkdir('uploads/blog/'.$id.'/thumb');
                // }

                $validPath = 'uploads/blog';
                $uploadResponse = Helper::getUploadedFileName($photoFile, $validPath, 0, 0, 1);
                if($uploadResponse['status'] == 1){
                    $photo_name = $uploadResponse['file_name'];
                    $photo_original_name = $uploadResponse['file_original_name'];
                    $photo_size = $uploadResponse['file_size'];
                    $photo_extention = $uploadResponse['file_extention'];

                    File::delete(public_path($validPath.'/').$blog->photo_name);
                    File::delete(public_path($validPath.'/thumb/').$blog->photo_name);

                    UserBlog::find($id)->update([
                        'blog_title' => $title,
                        'blog_description' => $description,
                        'photo_name' => $photo_name,
                        'photo_original_name' => $photo_original_name,
                        'photo_size' => $photo_size,
                        'photo_extention' => $photo_extention,
                    ]);

                }else{
                    $output['messege'] = $uploadResponse['errors'];
                    $output['msgType'] = 'danger';
                    return redirect()->back()->with($output);
                } 

            }else{

                UserBlog::find($id)->update([
                    'blog_title' => $title,
                    'blog_description' => $description,
                ]);

            }

            $output['messege'] = 'Blog has been Updated';
            $output['msgType'] = 'success';
        
            return redirect()->back()->with($output);
        }else{
            return redirect()->back()->withErrors($validator);
        }
    }

    public function destroy($id)
    {
        $blog = UserBlog::valid()->find($id);
        $imgPath = 'uploads/blog';
        File::delete(public_path($imgPath.'/').$blog->photo_name);
        File::delete(public_path($imgPath.'/thumb/').$blog->photo_name);

        UserBlog::valid()->find($id)->delete();
    }
}
