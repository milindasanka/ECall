<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\mailpost;
use App\Models\apply_job;
use App\Models\jobs;
use App\Models\User;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MeetingController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * create meeting
     */
    function create(Request $request){
        $Server = env('BBSERVER');
        $Shared_secret = env('BBSHARED_SECRET');
        $name = $request->job_id;
        $meetingID = 'ERMRS'.$name;
        $userx = apply_job::where('id', $name)->first();
        $moderator = User::where('id', $userx['user_id'])->first();
        $attendee = User::where('id', $userx['applyer_id'])->first();
        $moderatorPW = 'mPW'.$name;
        $attendeePW = 'stPW'.$name;
        $logoutURL = env('LOGOUTURL');
        $checksumurl ='createname='.$name.'+Meeting&meetingID='.$meetingID.'&logoutURL='.$logoutURL.'&attendeePW='.$attendeePW.'&duration=120&allowStartStopRecording=true&autoStartRecording=false&record=false&voiceBridge=70091&welcome=%3Cbr%3EWelcome+to+%3Cb%3E%25%25CONFNAME%25%25%3C%2Fb%3E%21&moderatorPW='.$moderatorPW.$Shared_secret;
        $checksum = hash('sha1', $checksumurl);
        //create meeting
        $url = $Server.'/create?name='.$name.'+Meeting&meetingID='.$meetingID.'&logoutURL='.$logoutURL.'&attendeePW='.$attendeePW.'&duration=120&allowStartStopRecording=true&autoStartRecording=false&record=false&voiceBridge=70091&welcome=%3Cbr%3EWelcome+to+%3Cb%3E%25%25CONFNAME%25%25%3C%2Fb%3E%21&moderatorPW='.$moderatorPW.'&checksum='.$checksum;
        $response = file_get_contents($url);


        if ($response !== false) {
            $xml = simplexml_load_string($response);
            if ($xml !== false) {
                if('SUCCESS'==$xml->returncode){
                    apply_job::where('id', $name)->update(['status' => '2']);
                    apply_job::where('id', $name)->update(['date' => $request->time]);

                    $dateTime = new DateTime($request->time);
                    $formattedTime = $dateTime->format('Y-m-d h:i A');

                    $htmlContent = '
                    <!DOCTYPE html>
                        <html lang="en">
                        <head>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <title>Your Interview is Scheduled</title>
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
                                <h1>Your Interview is Scheduled </h1>
                                <p>Hey,</p>

                                <p> Schedule your interview on the job application [ID: '.$request->job_id.']. Please join the meeting using the dashboard below at the time indicated</p>
                                <a href="http://127.0.0.1:8000/requestd" class="button" style="color: white;">Join Meeting</a>
                                <p>Time: '.$formattedTime.'
                                </p>

                                <p>Best regards,<br>Team FLEXHAIER </p>

                            </div>
                        </body>
                    </html>';

                    $mailpost = new mailpost();
                    $mailpost->sendmail($attendee['email'],'Your Interview is Scheduled',$htmlContent);

                    return redirect()->route('application');
                }else {
                    return back();
                }
            } else {
                return back();
            }
        } else {
            return back();
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
     * modulator join
     */
    function Modulatorjoin(Request $request){
        $Server = env('BBSERVER');
        $Shared_secret = env('BBSHARED_SECRET');
        $name = $request->job_id;
        $username = $id = Auth::user()->name;
        $meetingID = 'ERMRS'.$name;
        $userx = apply_job::where('id', $name)->first();
        $moderator = User::where('id', $userx['user_id'])->first();
        $moderatorPW = 'mPW'.$name;

        $checksumurl ='joinfullName='.$username.'+Meeting&meetingID='.$meetingID.'&password='.$moderatorPW.'&redirect=true'.$Shared_secret;
        $checksum = hash('sha1', $checksumurl);

        $url =$Server.'/join?fullName='.$username.'+Meeting&meetingID='.$meetingID.'&password='.$moderatorPW.'&redirect=true&checksum='.$checksum;

        apply_job::where('id', $name)->update(['status' => '3']);
        $csrfToken = csrf_token();
        $script = "
            <script>
                var url = '" . $url . "';
                window.onload = function() {
                    // Open new window
                    window.open(url, '_blank');

                    // Create form and submit it
                    var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '" . route('starmeeting') . "';

                    var csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = '" . $csrfToken . "';
                    form.appendChild(csrfInput);

                    var input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'job_id';
                    input.value = '" . $name . "';
                    form.appendChild(input);

                    document.body.appendChild(form);
                    form.submit();
                }
            </script>
        ";

        return response($script)->header('Content-Type', 'text/html');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
     * atandee join
     */
    function Atendeejoin (Request $request){
        $Server = env('BBSERVER');
        $Shared_secret = env('BBSHARED_SECRET');
        $name = $request->job_id;
        $username = $id = Auth::user()->name;
        $meetingID = 'ERMRS'.$name;
        $userx = apply_job::where('id', $name)->first();
        $atendee = User::where('id', $userx['user_id'])->first();
        $atendeePW = 'stPW'.$name;
        $checksumurl ='joinfullName='.$username.'+Meeting&meetingID='.$meetingID.'&password='.$atendeePW.'&redirect=true'.$Shared_secret;
        $checksum = hash('sha1', $checksumurl);

        $url =$Server.'/join?fullName='.$username.'+Meeting&meetingID='.$meetingID.'&password='.$atendeePW.'&redirect=true&checksum='.$checksum;

        apply_job::where('id', $name)->update(['status' => '4']);
        $script = " <script>
                    var url = '".$url."';
                    window.location.href = url;
                    </script>";
        return response($script);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     * meeting end
     */
    function Endmeeting(){

        $id = Auth::user()->id;
        $job = apply_job::where('user_id', $id)
                            ->where('status', 4)
                            ->get();
        if(empty(count($job) == 0)){
            apply_job::where('id', $job[0]['id'])->update(['status' => '5']);
            return redirect()->route('application');
        }else{
            return redirect()->route('welcome');
        }
    }

    function starmeeting(Request $request){
        $application = $request->job_id;
        $jobid = apply_job::where('id', $application)->first();
        $quections = jobs::where('id', $jobid['job_id'])->first();

        return view('user.questions', ['questions' => $quections, 'application'=>$application]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * get points
     */
    function getpoints(Request $request){
        $id = $request->id;
        $coutout = $request->coutouts;
        $validatedData = $request->validate([
            'q1' => 'required|string',
            'q2' => 'required|string',
            'q3' => 'required|string',
            'q4' => 'required|string',
            'q5' => 'required|string',
        ]);
        $answers = $validatedData;
        $total = $answers['q1'] + $answers['q2'] + $answers['q3'] + $answers['q4'] + $answers['q5'];
        if($total >= $coutout){
           return $this->approve($id);
        }else{
           return $this->Reject($id);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * approve
     */
    function approve($id){
        apply_job::where('id', $id)->update(['status' => '6']);
        $joid = apply_job::where('id', $id)->first();
        $jobid = jobs::where('id', $joid)->first();
        $email = User::where('id', $joid['applyer_id'])->first();

        $htmlContent = '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Selection</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            background-color: #ffffff;
            margin: 50px auto;
            padding: 20px;
            max-width: 600px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #4CAF50;
            padding: 10px;
            text-align: center;
            color: white;
            border-radius: 8px 8px 0 0;
        }
        .content {
            padding: 20px;
            line-height: 1.6;
        }
        .content p {
            margin: 0 0 10px;
        }
        .footer {
            text-align: center;
            padding: 10px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>You Selected</h1>
        </div>
        <div class="content">
            <p>Dear Sir</p>
            <p>We are delighted to inform you that you have been selected for the position of '.$joid['job_category'].' at '.$joid['company_name'].'.</p>
            <p>After carefully reviewing your application and conducting the interview, we believe that you possess the skills and experience necessary to excel in this role.</p>
            <p>We are excited about the possibility of you joining our team and contributing to our companys success.</p>
            <p>Please find attached the offer letter with further details about the position, salary, and benefits. We kindly request you to review it and respond with your acceptance at your earliest convenience.</p>
            <p>If you have any questions or need further clarification, feel free to reach out to us.</p>
            <p>We look forward to hearing from you soon.</p>
            <p>Best regards,</p>
        </div>
        <div class="footer">
            <p>&copy; 2024 Flexhair. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
';
        $mailpost = new mailpost();
        $mailpost->sendmail($email['email'],'You Selected',$htmlContent);
        return redirect()->route('application');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * reject
     */
    function Reject($id){
        $joid = apply_job::where('id', $id)->first();
        $jobid = jobs::where('id', $joid)->first();
        $email = User::where('id', $joid['applyer_id'])->first();

        $htmlContent = '
                    <!DOCTYPE html>
                        <html lang="en">
                        <head>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <title>Interview Outcome</title>
                            <style>
                                body {
                                    font-family: Arial, sans-serif;
                                    line-height: 1.6;
                                    margin: 0;
                                    padding: 0;
                                    background-color: #f4f4f4;
                                    color: #333;
                                }
                                .container {
                                    width: 80%;
                                    max-width: 600px;
                                    margin: 50px auto;
                                    background: #fff;
                                    padding: 20px;
                                    border-radius: 8px;
                                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                                }
                                .header, .footer {
                                    text-align: center;
                                    margin-bottom: 20px;
                                }
                                .footer {
                                    font-size: 0.9em;
                                    color: #666;
                                }
                                .content {
                                    margin-bottom: 20px;
                                }
                                .btn {
                                    display: inline-block;
                                    padding: 10px 20px;
                                    margin-top: 20px;
                                    background-color: #007bff;
                                    color: #fff;
                                    text-decoration: none;
                                    border-radius: 5px;
                                    text-align: center;
                                }
                                .btn:hover {
                                    background-color: #0056b3;
                                }
                            </style>
                        </head>
                        <body>
                            <div class="container">
                                <div class="header">
                                </div>
                                <div class="content">
                                    <p>Dear Sir,</p>
                                    <p>I hope this message finds you well.</p>
                                    <p>I wanted to personally thank you for taking the time to interview for the <strong>'.$joid['job_category'].'</strong> position at <strong>'.$joid['company_name'].'</strong>. We appreciate the effort you put into preparing for and attending the interview.</p>
                                    <p>After careful consideration, we have decided to move forward with another candidate whose qualifications more closely match the requirements for the role at this time.</p>
                                    <p>Please know that this decision was not easy, as we were impressed by your skills and experience. We encourage you to apply for future openings that match your profile, as we believe you could be a great fit for other opportunities within our organization.</p>
                                    <p>Once again, thank you for your interest in <strong>'.$joid['company_name'].'</strong> and for the time you invested in the interview process. We wish you the very best in your job search and future career endeavors.</p>
                                    <p>If you have any questions or would like feedback on your interview, please feel free to reach out.</p>
                                    <p>Best regards,</p>
                                </div>
                                <div class="footer">
                                    <p>&copy; 2024 Flexhaire. All rights reserved.</p>
                                </div>
                            </div>
                        </body>
                        </html>
';
        apply_job::where('id', $id)->update(['status' => '7']);
        $mailpost = new mailpost();
        $mailpost->sendmail($email['email'],'Try Again',$htmlContent);
        return redirect()->route('application');
    }

    function approvex(Request $request){
        $id = $request->job_id;

        return $this->approve($id);
    }

    function rejectx(Request $request){
        $id = $request->job_id;

        return $this->reject($id);
    }
}
