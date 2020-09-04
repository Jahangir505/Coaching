<?php

namespace App\Http\Controllers;

use App\User;
use Image;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserRegistrationController extends Controller
{



    public function userList(){
        
        if(Auth::user()->role=='Admin'){
            $users = User::all();
            return view('admin.users.user-list',['users'=>$users]);
        }else{
             return back();
            }
            
       
    }


    public function showRegistrationForm(){
        if(Auth::user()->role=='Admin'){
            return view('admin.users.regi');
        }else{
             return back();
            }
    
    }


    public function userSave(Request $request){
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $users = User::all();

        return view('admin.users.user-list',['users'=>$users]);

    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'role' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string','min:13', 'max:13'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }


     /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'role' => $data['role'],
            'name' => $data['name'],
            'mobile' => $data['mobile'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }


    public function userProfile($userId){
        $user = User::find($userId);
        return view('admin.users.profile',compact('user'));
    }


    public function userUpdate($id){
        $user = User::find($id);
        return view('admin.users.update',compact('user'));
    }


    public function userInfoUpdate(Request $request){
        
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:13|min:13',
            'email' => 'required|email|string|max:255',
        ]);
        $user = User::find($request->user_id);
        $user->name = $request->name;
        $user->mobile = $request->mobile;
        $user->email = $request->email;

        $user->save();

        return redirect("/user-profile/$request->user_id")->with('msg','User Profile Updated Successfylly');

    }

    public function changeUserAvatar($id){
        $user = User::find($id);

        return view('admin.users.avatar',compact('user'));
    }

    public function updateUserPhoto(Request $request){
        $user = User::find($request->user_id);

        $file = $request->file('avatar');
        $iamgeName = $file->getClientOriginalName();
        $directory = 'admin/assets/avatar/';
        $imageUrl = $directory.$iamgeName;
        // $file->move($directory,$imageUrl);

        Image::make($file)->resize(300, 300)->save($imageUrl);

        $user->avatar = $iamgeName;
        $user->save();

        return redirect("/user-profile/$request->user_id")->with('msg','User Profile Updated Successfylly');
    }


    public function changeUserPassword($id){
        $user = User::find($id);
        return view('admin.users.password',compact('user'));
    }


    public function userPasswordUpdate(Request $request){
        $this->validate($request,[
            'new_password' => 'required|string|min:8',
        ]);

        $oldPass = $request->password;
        $user = User::find($request->user_id);

        if(Hash::check($oldPass,$user->password)){
            $user->password = Hash::make($request->new_password);
            $user->save();

            return redirect("/user-profile/$request->user_id")->with('msg','User Password Updated Successfylly');
        }else{
            return back()->with('error_mess','Old Password does not match. Please try again...');
        }

    }
}

