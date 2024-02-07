<?php

namespace App\Http\Controllers;

use App\Models\emuser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('profile');
    }

    public function cvprofile()
    {
        $profiledata  = emuser::where('email', Auth::user()->email)
            ->first();
        return view('cvprofile', $profiledata);
    }

    public function updatecv(Request $request){
        $skillsArray = array();
        $skillsArray = explode(',', $request->skills);
        $skillsArray = array_map('trim', $skillsArray);
        $file = $request->file('file');
        $file_url = '';
        if($file){
            $forignial_name = $file->getClientOriginalName();
            $extension = pathinfo($forignial_name, PATHINFO_EXTENSION);
            $fileName = time(). '_' . $request->fname.'.'.$extension;
            $file->storeAs('public/uploads', $fileName);
            $file_url = '/storage/uploads/'.$fileName;
        }
        $record = emuser::where('email', $request->email)->first();
            $record->f_name = $request->fname;;
            $record->l_name = $request->lname;
            $record->position = $request->position;
            $record->skills = $skillsArray;
            $record->description = $request->about_me;
            $record->education_level = $request->education_level;
            $record->experience_level = $request->experience_level;
            $record->birthday = $request->dob;
            $record->contact_no =$request->phone;
            $record->cv = $file_url;
            $record->save();
        return $this->cvprofile()->render();
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::user()->id,
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|max:12|required_with:current_password',
            'password_confirmation' => 'nullable|min:8|max:12|required_with:new_password|same:new_password'
        ]);

        $user = User::findOrFail(Auth::user()->id);
        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');

        if (!is_null($request->input('current_password'))) {
            if (Hash::check($request->input('current_password'), $user->password)) {
                $user->password = $request->input('new_password');
            } else {
                return redirect()->back()->withInput();
            }
        }

        $user->save();

        return redirect()->route('profile')->withSuccess('Profile updated successfully.');
    }
}
