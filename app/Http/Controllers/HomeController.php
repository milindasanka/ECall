<?php

namespace App\Http\Controllers;

use App\Models\jobs;
use App\Models\User;
use Illuminate\Http\Request;
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
        $users = User::count();

        $widget = [
            'users' => $users,
            //...
        ];

        return view('home', compact('widget'));
    }

    public function userlist(){
        $data = User::all(); // Replace YourModel with your actual model name

        return view('userlist', ['data' => $data]);
    }


    public function jobslist(){
        $data = User::all(); // Replace YourModel with your actual model name

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
        $users = User::count();

        $widget = [
            'users' => $users,
            //...
        ];
        return view('user.userHome', compact('widget'));
    }



}

