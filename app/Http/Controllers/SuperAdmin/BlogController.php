<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserBlog;
use App\Models\UserComments;


use DB;
use Helper;
use Validator;
use Str;
use Auth;
use File;
use Image;

class BlogController extends Controller
{
    public function index(){
        $data['activeMenu'] = "blog-post";
        $data['allBlogs'] = UserBlog::valid()->get();

        return view('super-admin.blog-post.listData', $data);
    }

    public function edit($id)
    {
        $data['blog'] = UserBlog::valid()->find($id);
        return view('super-admin.blog-post.update', $data);
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

                $validPath = 'uploads/blog';
                $uploadResponse = Helper::getUploadedFileName($photoFile, $validPath);
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

    public function blogAdminCommentList($id){
 
        $data['activeMenu'] = "blog-post";
        $data['allComments'] = UserComments::valid()->where('blog_id', $id)->get();
        $data['blogInfo'] = UserBlog::valid()->find($id);

        return view('super-admin.blog-post.commentList', $data);
    }

    public function blogAdminCommentUpdate($commentId){

        $data['UserComment'] = UserComments::valid()->find($commentId);
        return view('super-admin.blog-post.commentUpdate', $data);
    }

    public function blogAdminCommentUpdateAction(Request $request, $commentId){

        $validator = Validator::make($request->all(), [
            'comment'         => 'required',
        ]);

        if ($validator->passes()) {
            $comment = $request->comment;
            UserComments::find($commentId)->update([
                'comment' => $comment,
            ]);

            $output['messege'] = 'Comment has been Updated';
            $output['msgType'] = 'success';
        
            return redirect()->back()->with($output);
        }else{
            return redirect()->back()->withErrors($validator);
        }

    }

    public function blogAdminCommentDelete($commentId){
        UserComments::find($commentId)->delete();
    }
}
