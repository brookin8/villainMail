<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $users = \App\User::all();
        $recipient = '';
        $subject = '';
        $recipient_ids=[];
        
        if($request->session()->get('recipient')) {
            $current_recipient = $request->session()->pull('recipient');
            $recipient = \App\User::whereIn('id', $current_recipient)->get();
            foreach($recipient as $recipients) {
                array_push($recipient_ids,$recipients->id);
            }
        } 

        if($request->session()->get('subject')) {
            $subject = 'RE: ' . $request->session()->pull('subject');
        }
        return view('messages.create',compact('users','recipient','subject','recipient_ids'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $message = new \App\Message;
        // $recipients = request('recipient');
        
        $message->subject = request('subject');
        $message->body = request('body');
        $message->sender_id = \Auth::user()->id;
        // $message->recipient_id = request('recipient');
        $message->is_read = false;
        $message->is_starred = false;
        $message->save();

        

        foreach ($_POST['recipient'] as $recipients)
        {
            // error_log($recipients);
            $message_recipient = new \App\Message_Recipient;
            $message_recipient->message_id = $message->id;
            $message_recipient->recipient_id = $recipients;
            $message_recipient->sender_id = \Auth::user()->id;
            $message_recipient->save();
        }
        
        return redirect('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $message = \App\Message::find($id);
        $message->is_read = true;
        $message->save();

        if($message->sender_id === \Auth::user()->id) {
        
            $recipients = \DB::table('message_recipient')
                ->join('users', 'message_recipient.recipient_id', '=', 'users.id')
                ->select('message_recipient.*', 'users.name as name')
                ->where('message_recipient.message_id',$message->id)
                ->get();

            $finalRecipients = [];

            foreach($recipients as $recipient) {
                array_push($finalRecipients, $recipient->recipient_id);
            }

            $request->session()->put('recipient', $finalRecipients);
            $request->session()->put('subject', $message->subject);

        } else {
            $request->session()->put('recipient', $message->sender_id);
            $request->session()->put('subject', $message->subject);
        } 

        return view('messages.show',compact('message','recipients'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $message = \App\Message::find($id);
        if($message->is_starred) {
             $message->is_starred = false;
        } else {
            $message->is_starred = true;
        }
        $message->save();

        return redirect('/messages/' . $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = \App\Message::find($id);
        $message->delete();
        return redirect('home');
    }
}
