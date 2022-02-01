<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use DB;
use Str;
use Auth;
use File;
use Helper;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function signUp(Request $request){

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'userName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'photo' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $name = $request->name;
        $userName = $request->userName;
        $email = $request->email;
        $password = $request->password;
        $photoFile = $request->photo;

        $photo_name = Null;
        $photo_original_name = Null;
        $photo_size = Null;
        $photo_extention = Null;

        if(isset($photoFile)){
            $validPath = 'uploads/userProfile';
            $uploadResponse = Helper::getUploadedFileName($photoFile, $validPath);
            if($uploadResponse['status'] == 1){
                $photo_name = $uploadResponse['file_name'];
                $photo_original_name = $uploadResponse['file_original_name'];
                $photo_size = $uploadResponse['file_size'];
                $photo_extention = $uploadResponse['file_extention'];
            }else{
                $output['messege'] = $uploadResponse['errors'];
                $output['msgtype'] = 'danger';
                return response()->json($output);
            } 
        }

        $data = User::create([
            'name' => $name,
            'userName' => $userName,
            'email' => $email,
            'password' => Hash::make($password),
            'photo_name' => $photo_name,
            'photo_original_name' => $photo_original_name,
            'photo_size' => $photo_size,
            'photo_extention' => $photo_extention,
        ]);

        $output['messege'] = "User Register successfully";
        $output['msgtype'] = 'success';

        Auth::loginUsingId($data->id);

        return response()->json($output);
 

    }
}
