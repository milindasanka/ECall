<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\apply_job;
use App\Models\User;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    function create(Request $request){
        $Server = env('BBSERVER');
        $Shared_secret = env('BBSHARED_SECRET');
        $name = $request->job_id;
        $meetingID = 'ERM'.$name;
        $userx = apply_job::where('id', $name)->first();
        $moderator = User::where('id', $userx['user_id'])->first();
        $attendee = User::where('id', $userx['applyer_id'])->first();
        $moderatorPW = $moderator['password'];
        $attendeePW = $attendee['password'];
        $checksumurl ='createname='.$name.'+Meeting&meetingID='.$meetingID.'&attendeePW='.$attendeePW.'&moderatorPW='.$moderatorPW.$Shared_secret;
        $checksum = hash('sha1', $checksumurl);
        //create meeting
        $url = $Server.'/create?name='.$name.'+Meeting&meetingID='.$meetingID.'&attendeePW='.$attendeePW.'&moderatorPW='.$moderatorPW.'&checksum='.$checksum;
        $response = file_get_contents($url);

        if ($response !== false) {
            $xml = simplexml_load_string($response);
            if ($xml !== false) {
                if('SUCCESS'==$xml->returncode){
                    apply_job::where('id', $name)->update(['status' => '2']);
                    apply_job::where('id', $name)->update(['date' => $request->time]);
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
        $meetingID = 'ERM'.$name;
        $userx = apply_job::where('id', $name)->first();
        $moderator = User::where('id', $userx['user_id'])->first();
        $moderatorPW = $moderator['password'];

        $checksumurl ='joinfullName='.$name.'+Meeting&meetingID='.$meetingID.'&password='.$moderatorPW.'&redirect=true'.$Shared_secret;
        $checksum = hash('sha1', $checksumurl);

        $url =$Server.'/join?fullName='.$name.'+Meeting&meetingID='.$meetingID.'&password='.$moderatorPW.'&redirect=true&checksum='.$checksum;
        $response = file_get_contents($url);
        apply_job::where('id', $name)->update(['status' => '3']);
        echo $response;
    }

    function Atendeejoin (Request $request){

    }

}
