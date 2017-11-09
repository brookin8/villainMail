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
    public function index(Request $request)
    {
        $currentUser = \Auth::user()->id;
        $messages = \App\Message::where('recipient_id',$currentUser)->orderBy('id','desc')->get();
        $messagesSent = \App\Message::where('sender_id',$currentUser)->orderBy('id','desc')->get();
        $recipients = \DB::table('message_recipient')
            ->join('users', 'message_recipient.recipient_id', '=', 'users.id')
            ->join('messages', 'message_recipient.message_id', '=', 'messages.id')
            ->select('message_recipient.*', 'users.name as name')
            // ->orderBy('id','desc')
            ->where('message_recipient.sender_id',$currentUser)
            ->get();

        $request->session()->put('recipient', '');
        $request->session()->put('subject', '');

        return view('home', compact('messages','messagesSent','recipients'));
    }
}
