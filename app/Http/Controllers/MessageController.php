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
        $recipientName = '';
        if($request->session()->get('recipient')) {
            $current_recipient = $request->session()->pull('recipient');
            $recipient = \App\User::where('id', $current_recipient)->get();
            //$recipientName = $recipient->name;
        }
        if($request->session()->get('subject')) {
            $subject = 'RE: ' . $request->session()->pull('subject');
        }
        return view('messages.create',compact('users','recipient','subject'));

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
        
        $message->subject = request('subject');
        $message->body = request('body');
        $message->sender_id = \Auth::user()->id;
        $message->recipient_id = request('recipient');
        $message->is_read = false;
        $message->is_starred = false;

        $message->save();
        
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

        $request->session()->put('recipient', $message->sender_id);
        $request->session()->put('subject', $message->subject);

        return view('messages.show',compact('message'));
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
        //
    }
}
