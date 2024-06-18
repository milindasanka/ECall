<?php

namespace App\Http\Controllers;

use App\Models\jobs;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\apply_job;
use Illuminate\Support\Facades\Auth;

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

        $jobs = jobs::where('is_active',1)->count();
        $applications = apply_job::count();
        $requested = apply_job::where('status', 2)->count();
        $users = User::count();
        $jobscat = [
            'se' => round(jobs::where('job_category','Software Engineer')->where('is_active',1)->count()/$jobs * 100, 0),
            'pm' => round(jobs::where('job_category','Project Manager')->where('is_active',1)->count()/$jobs * 100, 0),
            'qa' => round(jobs::where('job_category','QA Engineer')->where('is_active',1)->count()/$jobs * 100, 0),
            'ui' => round(jobs::where('job_category','UI UX Designer')->where('is_active',1)->count()/$jobs * 100, 0),
            'tl' => round(jobs::where('job_category','Tech Lead')->where('is_active',1)->count()/$jobs * 100, 0),
            'gd' => round(jobs::where('job_category','Graphic Designer')->where('is_active',1)->count()/$jobs * 100, 0),
            'ba' => round(jobs::where('job_category','Business Analyst')->where('is_active',1)->count()/$jobs * 100, 0),
            'sa' => round(jobs::where('job_category','System Administrator')->where('is_active',1)->count()/$jobs * 100, 0),
            'de' => round(jobs::where('job_category','Data Engineer')->where('is_active',1)->count()/$jobs * 100, 0),
            'sar' => round(jobs::where('job_category','Software Architect')->where('is_active',1)->count()/$jobs * 100, 0),
        ];

        $widget = [
            'users' => $users,
            'jobs' => $jobs,
            'applications' => $applications,
            'requested' => $requested,
            //...
        ];

        return view('home', compact('widget','jobscat'));
    }

    public function userlist(){
        $data = User::all();

        return view('userlist', ['data' => $data]);
    }


    public function jobslist(){
        $data = jobs::where('is_active', '1')
                ->get();

        return view('jobslist', ['data' => $data]);
    }

    public function home2(){
        $id = Auth::user()->id;
        if($id === 1){
            return $this->index()->render();
        }else{
            return $this->userhome()->render();
        }
    }

    public function userhome(){
        $id = Auth::user()->id;
        $users = User::count();
        $jobs = jobs::where('is_active',1)->count();
        $applications = apply_job::where('user_id', $id)->count();
        $requested = apply_job::where('applyer_id', $id)->count();
        $jobscat = [
            'se' => round(jobs::where('job_category','Software Engineer')->where('is_active',1)->count()/$jobs * 100, 0),
            'pm' => round(jobs::where('job_category','Project Manager')->where('is_active',1)->count()/$jobs * 100, 0),
            'qa' => round(jobs::where('job_category','QA Engineer')->where('is_active',1)->count()/$jobs * 100, 0),
            'ui' => round(jobs::where('job_category','UI UX Designer')->where('is_active',1)->count()/$jobs * 100, 0),
            'tl' => round(jobs::where('job_category','Tech Lead')->where('is_active',1)->count()/$jobs * 100, 0),
            'gd' => round(jobs::where('job_category','Graphic Designer')->where('is_active',1)->count()/$jobs * 100, 0),
            'ba' => round(jobs::where('job_category','Business Analyst')->where('is_active',1)->count()/$jobs * 100, 0),
            'sa' => round(jobs::where('job_category','System Administrator')->where('is_active',1)->count()/$jobs * 100, 0),
            'de' => round(jobs::where('job_category','Data Engineer')->where('is_active',1)->count()/$jobs * 100, 0),
            'sar' => round(jobs::where('job_category','Software Architect')->where('is_active',1)->count()/$jobs * 100, 0),
        ];

        $widget = [
            'users' => $users,
            'jobs' => $jobs,
            'applications' => $applications,
            'requested' => $requested,
        ];
        return view('user.userHome', compact('widget','jobscat'));
    }

}

