<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function send(MessageRequest $request)
    {
        $validated = $request->validated();

        Message::create([
            'sender_id' => auth()->id(),
            'user_id' => auth()->id(),
            'ticket_id' => $validated->ticket_id,
            'content' => $validated->content
        ]);


        return redirect()->back();
    }
}
