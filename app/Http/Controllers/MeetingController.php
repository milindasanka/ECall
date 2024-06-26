<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\mailpost;
use App\Models\apply_job;
use App\Models\User;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MeetingController extends Controller
{
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
        $checksumurl ='createname='.$name.'+Meeting&meetingID='.$meetingID.'&attendeePW='.$attendeePW.'&duration=120&allowStartStopRecording=true&autoStartRecording=false&record=false&voiceBridge=70091&welcome=%3Cbr%3EWelcome+to+%3Cb%3E%25%25CONFNAME%25%25%3C%2Fb%3E%21&moderatorPW='.$moderatorPW.$Shared_secret;
        //$checksumurl2 ='endmeetingID='.$meetingID.'&password='.$moderatorPW.$Shared_secret;
        $checksum = hash('sha1', $checksumurl);
        //create meeting
        $url = $Server.'/create?name='.$name.'+Meeting&meetingID='.$meetingID.'&attendeePW='.$attendeePW.'&duration=120&allowStartStopRecording=true&autoStartRecording=false&record=false&voiceBridge=70091&welcome=%3Cbr%3EWelcome+to+%3Cb%3E%25%25CONFNAME%25%25%3C%2Fb%3E%21&moderatorPW='.$moderatorPW.'&checksum='.$checksum;
        // $url = $Server.'/end?meetingID='.$meetingID.'&password='.$moderatorPW.'&checksum='.$checksum;
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

        $script = " <script>
                    var url = '".$url."';
                    window.location.href = url;
                    </script>";
        return response($script);
    }

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

}
