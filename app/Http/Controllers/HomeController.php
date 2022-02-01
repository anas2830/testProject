<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Models\UserBlog;
use App\User;

use DB;
use Str;
use Auth;
use File;
use Helper;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['firstTwoBlogs'] = UserBlog::valid()->orderBy('id', 'ASC')->take(2)->get();
        $data['middleBlogs'] = UserBlog::valid()->orderBy('id', 'ASC')->skip(2)->take(1)->get();
        $data['lastTwoBlogs'] = UserBlog::valid()->orderBy('id', 'ASC')->skip(3)->take(2)->get();

        $data['recent_posts'] = $recent_posts = DB::table('user_blogs')->where('valid', 1)->orderBy('id', 'DESC')->take(6)->get();

        foreach($recent_posts as $post){
            $post->authorName = DB::table('users')->where('id', $post->gen_user_id)->first()->name;
            $post->authorImage = DB::table('users')->where('id', $post->gen_user_id)->first()->photo_name;
        }

        return view('website.home', $data);
    }

    public function userProfile(Request $request){

        $data['user_id'] = $user_id = Auth::guard('web')->user()->id;
        $data['all_blogs'] = UserBlog::valid()->where('gen_user_id', $user_id)->orderBy('id', 'desc')->get();

        $data['userInfo'] = DB::table('users')->find($user_id);

        return view('website.profile', $data);
    }


    public function profileUpdate(Request $request){

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'userName' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $name = $request->name;
        $userName = $request->userName;
        $password = $request->password;
        $photoFile = $request->photo;
        $data['user_id'] = $user_id = Auth::guard('web')->user()->id;
        $authInfo = DB::table('users')->find($user_id);

        if(isset($photoFile)){
            $validPath = 'uploads/userProfile';
            $uploadResponse = Helper::getUploadedFileName($photoFile, $validPath);
            if($uploadResponse['status'] == 1){
                File::delete(public_path($validPath.'/').$authInfo->photo_name);
                File::delete(public_path($validPath.'/thumb/').$authInfo->photo_name);
                $photo_name = $uploadResponse['file_name'];
                $photo_original_name = $uploadResponse['file_original_name'];
                $photo_size = $uploadResponse['file_size'];
                $photo_extention = $uploadResponse['file_extention'];

                User::find($user_id)->update([
                    'name' => $name,
                    'userName' => $userName,
                    'password' => Hash::make($password),
                    'photo_name' => $photo_name,
                    'photo_original_name' => $photo_original_name,
                    'photo_size' => $photo_size,
                    'photo_extention' => $photo_extention,
                ]);
            }else{
                $output['messege'] = $uploadResponse['errors'];
                $output['msgtype'] = 'danger';
                return response()->json($output);
            } 
        }else{
            User::find($user_id)->update([
                'name' => $name,
                'userName' => $userName,
                'password' => Hash::make($password)
            ]);
        }

        $output['messege'] = "Profile Update successfully";
        $output['msgtype'] = 'success';

        return response()->json($output);
    }
}
