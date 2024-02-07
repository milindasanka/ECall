<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\apply_job;
use App\Models\emuser;
use App\Models\jobs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class jobController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function joblist(){
        $id = Auth::user()->id;
        if($id === 1){
            $data = jobs::where('is_active', '1')
                    ->get();
        }else{
            $data = jobs::where('emusers_id', $id)
                ->where('is_active', '1')
                ->get();
        }
      return view('user.jobslist',['data' => $data]);
    }

    function addNewjob(Request $request){
        $jobs = new jobs;
        $jobs->job_title = $request->job_title;
        $jobs->job_category = $request->job_category;
        $jobs->job_description = $request->job_description;
        $jobs->place = $request->place;
        $jobs->is_active = '1';
        $jobs->emusers_id = Auth::user()->id;
        $jobs->save();
        return $this->joblist()->render();
    }

    function jobdelu(Request $request){
        $jobid = $request->job_id;
        jobs::where('id', $jobid)->update(['is_active' => '0']);
        return $this->joblist()->render();
    }

    function jobview($id){
        $data = jobs::where('id', $id)
                ->get();

        return view('user.jobview',['data' => $data]);
    }

    function applythisjob($id){

        $job = jobs::where('id', $id)
                ->get();
        $job_id = $id;
        $user_id = $job[0]->emusers_id;
        $applyer_id = $id = Auth::user()->id;
        $apply = new apply_job;
        $apply->job_id = $job_id;
        $apply->user_id = $user_id;
        $apply->applyer_id = $applyer_id;

        $jobck = apply_job::where('job_id', $job_id)
            ->where('applyer_id', $applyer_id)
            ->get();
        if($jobck->isEmpty()){
            $apply->save();
            echo '<script>alert("Apply Job Complete!");</script>';
            return $this->joblist()->render();
        }else{
            echo '<script>alert("You Already apply this job!");</script>';
            return redirect()->route('welcome');
        }

    }

    function application(){
        $id = Auth::user()->id;
        $data = apply_job::where('user_id', $id)
            ->get();
        return view('user.application_list',['data' => $data]);

    }

    function deleteapplication(Request $request){
        $jobid = $request->job_id;
        apply_job::where('id', $jobid)->delete();
        return $this->application()->render();
    }

    function deleteapplicationx(Request $request){
        $jobid = $request->job_id;
        apply_job::where('id', $jobid)->delete();
        return $this->requestd()->render();
    }


    function acceptjob(Request $request){
        $jobid = $request->job_id;
        apply_job::where('id', $jobid)->update(['status' => '1']);
        return $this->application()->render();
    }

    function viewappliction (Request $request){
        $appid = $request->job_id;
        $user_id = apply_job::where('id', $appid)
                   ->first();
        ;

        $userz = User::where('id', $user_id['applyer_id'])
                   ->first();

        $userx = emuser::where('email', $userz['email'])
                   ->first();

        $data = [
            'id' => $appid,
            'name' => $userx['f_name']. " ". $userx['l_name'],
            'email' => $userx['email'],
            'position' => $userx['position'],
            'contact_no' => $userx['contact_no'],
            'eduction_level' => $userx['education_level'],
            'experience_level' => $userx['experience_level'],
            'skills' => $userx['skills'],
            'description' => $userx['description'],
            'cv' => $userx['cv'],
        ];
        return view('user.viewapplicationin', $data);

    }

    function requestd(){
        $id = Auth::user()->id;
        $data = apply_job::where('applyer_id', $id)
            ->get();

        return view('user.requestdjobs', ['data' => $data]);
    }

}
