<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Moderator;



use DB;
use Str;
use Auth;
use File;
use Helper;


class ModeratorController extends Controller
{
    public function index(){
        $data['activeMenu'] = "moderator";
        $data['allModerator'] = Moderator::get();

        return view('super-admin.moderator.listData', $data);
    }

    public function create(){

        $data = [];
        return view('super-admin.moderator.create', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:moderators'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'photo' => ['required'],
        ]);

        if ($validator->passes()) {
            $name = $request->name;
            $email = $request->email;
            $password = $request->password;
            $photoFile = $request->photo;

            $validPath = 'uploads/moderatorProfile/';
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
     
            Moderator::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'photo_name' => $photo_name,
                'photo_original_name' => $photo_original_name,
                'photo_size' => $photo_size,
                'photo_extention' => $photo_extention,
            ]);

            $output['messege'] = 'Moderator has been Created';
            $output['msgType'] = 'success';
        
            return redirect()->back()->with($output);
        }else{
            return redirect()->back()->withErrors($validator);
        }
    }

    public function edit($id)
    {
        $data['moderator'] = Moderator::find($id);
        return view('super-admin.moderator.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->passes()) {
            $moderator = Moderator::find($id);

            $name = $request->name;
            $password = $request->password;
            $photoFile = $request->photo;

            if(isset($photoFile)){

                $validPath = 'uploads/moderatorProfile';
                $uploadResponse = Helper::getUploadedFileName($photoFile, $validPath);
                if($uploadResponse['status'] == 1){
                    $photo_name = $uploadResponse['file_name'];
                    $photo_original_name = $uploadResponse['file_original_name'];
                    $photo_size = $uploadResponse['file_size'];
                    $photo_extention = $uploadResponse['file_extention'];

                    File::delete(public_path($validPath.'/').$moderator->photo_name);
                    File::delete(public_path($validPath.'/thumb/').$moderator->photo_name);

                    Moderator::find($id)->update([
                        'name' => $name,
                        'password' => Hash::make($password),
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

                Moderator::find($id)->update([
                    'name' => $name,
                    'password' => Hash::make($password),
                ]);

            }

            $output['messege'] = 'Moderator has been Updated';
            $output['msgType'] = 'success';
        
            return redirect()->back()->with($output);
        }else{
            return redirect()->back()->withErrors($validator);
        }

    }

    public function destroy($id)
    {
        $moderator = Moderator::find($id);
        $imgPath = 'uploads/moderatorProfile';
        File::delete(public_path($imgPath.'/').$moderator->photo_name);
        File::delete(public_path($imgPath.'/thumb/').$moderator->photo_name);

        Moderator::find($id)->delete();
    }

}
