<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\emuser;
use App\Models\jobs;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function welcome(){
        $data = jobs::where('is_active', '1')
            ->get();
        return view('welcome', ['data' => $data]);
    }

    /**
     * @param Request $req
     * @return void
     *
     */
    public function adduser(Request $req){
        $fname = $req->fname;
        $lname = $req->lname;
        $email = $req->email;
        $about_me = $req->about_me;
        $position = $req->position;
        $education_level = $req->education_level;
        $experience_level = $req->experience_level;
        $dob = $req->dob;
        $sex = $req->sex;
        $phone = $req->phone;
        $password = $req->password;
        $User = new User;
        $User->name = $fname;
        $User->last_name = $lname;
        $User ->email = $email;
        $User ->password = $password;
        $emuser = new emuser;
        $emuser->f_name = $fname;
        $emuser->l_name = $lname;
        $emuser->position = $position;
        $emuser->contact_no = $phone;
        $emuser->education_level = $education_level;
        $emuser->description = $about_me;
        $skillsArray = array();
        $skillsArray = explode(',', $request->skills);
        $skillsArray = array_map('trim', $skillsArray);
        $emuser->skills = $skillsArray;
        $emuser->birthday = $dob;
        $emuser->experience_level = $experience_level;
        $emuser->email = $email;

        $emuser->save();
        $User ->save();

        return view('user.Userlogin');
    }
}
