<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function send(Request $request)
    {
        $message = Message::create([
            'user_id' => auth()->id(),
            'content' => $request->content,
            'ticket_id' => $request->ticket_id,
        ]);


        return redirect()->back();
    }
}
