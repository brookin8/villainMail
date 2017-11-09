<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentUser = \Auth::user()->id;
        $messages = \App\Message::where('recipient_id',1)->orderBy('id','desc')->get();
        $messagesSent = \App\Message::where('sender_id',$currentUser)->orderBy('id','desc')->get();

        return view('home', compact('messages','messagesSent'));
    }
}
