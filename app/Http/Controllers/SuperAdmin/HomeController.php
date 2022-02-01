<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Admin;
use App\Moderator;
use App\User;
use App\Models\UserBlog;
use App\Models\UserComments;


use DB;
use Str;
use Auth;
use File;
use Helper;


class HomeController extends Controller
{


    public function index(){
        $data['activeMenu'] = "home";
        $data['totalModarator'] = Moderator::count();
        $data['totalUser'] = User::count();
        $data['totalBlogs'] = UserBlog::valid()->count();
        $data['totalComments'] = UserComments::valid()->count();

        return view('super-admin.home', $data);
    }

    public function adminProfile(){

        $data['activeMenu'] = "profile";
        if(Auth::guard('admin')->check()){
            $data['user_id'] = $user_id = Auth::guard('admin')->user()->id;
            $data['userInfo'] = DB::table('admins')->find($user_id);
            $data['authRole'] = "admin";
        }else{
            $data['user_id'] = $user_id = Auth::guard('moderator')->user()->id;
            $data['userInfo'] = DB::table('moderators')->find($user_id);
            $data['authRole'] = "moderator";
        }

        return view('super-admin.profile', $data);
    }

    public function adminProfileUpdate(Request $request){

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'photo' => ['required'],
        ]);

        $name = $request->name;
        $password = $request->password;
        $photoFile = $request->photo;

        if(Auth::guard('admin')->check()){
            $data['user_id'] = $user_id = Auth::guard('admin')->user()->id;
            $authInfo = DB::table('admins')->find($user_id);
            $authTable = Admin::find($user_id);
            $imgPath = "adminProfile";
        }else{
            $data['user_id'] = $user_id = Auth::guard('moderator')->user()->id;
            $authInfo = DB::table('moderators')->find($user_id);
            $authTable = Moderator::find($user_id);
            $imgPath = "moderatorProfile";
        }
        

        if(isset($photoFile)){
            $validPath = 'uploads/'.$imgPath;
            $uploadResponse = Helper::getUploadedFileName($photoFile, $validPath);
            if($uploadResponse['status'] == 1){
                File::delete(public_path($validPath.'/').$authInfo->photo_name);
                File::delete(public_path($validPath.'/thumb/').$authInfo->photo_name);
                $photo_name = $uploadResponse['file_name'];
                $photo_original_name = $uploadResponse['file_original_name'];
                $photo_size = $uploadResponse['file_size'];
                $photo_extention = $uploadResponse['file_extention'];

                $authTable->update([
                    'name' => $name,
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
            $authTable->update([
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
