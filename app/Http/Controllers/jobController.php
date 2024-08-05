<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\mailpost;
use App\Models\apply_job;
use App\Models\emuser;
use App\Models\jobs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

    /**
     * @param Request $request
     * @return string
     * add new job
     */
    function addNewjob(Request $request){

        $validator = Validator::make($request->all(), [
            'job_title' => 'required|string|max:255',
            'job_category' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'job_description' => 'required|string',
            'skills' => 'required|string',
            'place' => 'required|string|max:255',
            'q1' => 'nullable|string',
            'q2' => 'nullable|string',
            'q3' => 'nullable|string',
            'q4' => 'nullable|string',
            'q5' => 'nullable|string',
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $skillsArray = array();
        $skillsArray = explode(',', $request->skills);
        $skillsArray = array_map('trim', $skillsArray);
        $jobs = new jobs;
        $jobs->job_title = $request->job_title;
        $jobs->job_category = $request->job_category;
        $jobs->company_name = $request->company_name;
        $jobs->job_description = $request->job_description;
        $jobs->skills = json_encode($skillsArray);
        $jobs->place = $request->place;
        $jobs->q1 = $request->q1;
        $jobs->q2 = $request->q2;
        $jobs->q3 = $request->q3;
        $jobs->q4 = $request->q4;
        $jobs->q5 = $request->q5;
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

    function jobview($id , $h){

        $data = jobs::where('id', $id)
                ->get();

        return view('user.jobview',['data' => $data , 'hide' => $h]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|string
     * apply job
     */
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

        $jobowner = jobs::where('id', $job_id)
            ->first();

        if($jobck->isEmpty()){
            $apply->save();
            $mail = User::where('id',$jobowner['emusers_id'])->first();
            $htmlContent = '
            <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>New Application Received</title>
                    <style>
                        /* Reset styles */
                        body, html {
                            margin: 0;
                            padding: 0;
                            font-family: Arial, sans-serif;
                            line-height: 1.6;
                        }

                        /* Body styles */
                        body {
                            background-color: #f4f4f4;
                            padding: 20px;
                        }

                        /* Container styles */
                        .container {
                            max-width: 600px;
                            margin: 0 auto;
                            background-color: #fff;
                            padding: 20px;
                            border-radius: 5px;
                            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                        }

                        /* Header styles */
                        h1, h2, h3, h4, h5, h6 {
                            margin-top: 0;
                        }

                        /* Button styles */
                        .button {
                            display: inline-block;
                            padding: 10px 20px;
                            background-color: #007bff;
                            color: #fff;
                            text-decoration: none;
                            border-radius: 4px;
                            transition: background-color 0.3s ease;
                        }

                        .button:hover {
                            background-color: #0056b3;
                        }
                    </style>
                </head>
                <body>
                    <div class="container">
                        <h1>Your Received New Application</h1>
                        <p>Hey,</p>

                        <p>You Received New Job Application for Job ID : '.$job_id.' </p>

                        <p>Please Loging Dashboard and Reveiw Application</p>

                        <p>Best regards,<br>Team FLEXHAIER </p>
                    </div>
                </body>
            </html>';

            $mailpost = new mailpost();
            $mailpost->sendmail($mail['email'],'New Application Received',$htmlContent);

            echo '<script>alert("Apply Job Complete!");</script>';
            return $this->requestd()->render();
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
        $applyer_id = apply_job::where('id',$jobid)->first();
        $mail = User::where('id',$applyer_id['applyer_id'])->first();
        $htmlContent = '
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Application Approved</title>
    <style>
        /* Reset styles */
        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        /* Body styles */
        body {
            background-color: #f4f4f4;
            padding: 20px;
        }

        /* Container styles */
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Header styles */
        h1, h2, h3, h4, h5, h6 {
            margin-top: 0;
        }

        /* Button styles */
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #0056b3;
        }

        /* Footer styles */
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 0.9em;
            color: #666;
        }

        .footer a {
            color: #007bff;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Congratulations!</h1>
        <p>Hey,</p>
        <p>Congratulations, Your Job Application [ID: '.$jobid.'] is Approved by Job Owner</p>
        <p>We will give you an interview soon.</p>
        <p>Best regards,<br>Team FLEXHAIER</p>
    </div>
    <div class="footer">
        <img src="https://i.ibb.co/zh0SzkT/logo.png" alt="logo" style="height: 50px;">
        <p>&copy; 2024 FLEXHAIER. All rights reserved. <br>
        Visit our <a href="https://www.flexhaier.com">website</a> or contact us at <a href="mailto:support@flexhaier.com">support@flexhaier.com</a></p>
    </div>
</body>
</html>
';
        $mailpost = new mailpost();
        $mailpost->sendmail($mail['email'],'Your Application Approved',$htmlContent);

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
