<?php

namespace App\Listeners;

use App\Events\NewTicket;
use App\Mail\NewTicketAdded;
use App\Mail\SendMailNewTicket;
use App\Mail\SendNewTicket;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendNotificationNewTicket
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewTicket $event): void
    {
        $users = User::where('role', '=', $event->ticket->role)->get();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new SendMailNewTicket($event->ticket));
        }
    }
}
