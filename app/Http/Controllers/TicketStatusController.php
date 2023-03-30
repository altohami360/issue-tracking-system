<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketStatusController extends Controller
{
    public function solve(Ticket $ticket)
    {
        $ticket->solve();

        return redirect()->back()->with('success', 'success');;
    }

    public function reopen(Ticket $ticket)
    {
        $ticket->reopen();

        return redirect()->back()->with('success', 'success');;
    }

    public function archive(Ticket $ticket)
    {
        $ticket->archive();

        return redirect()->back()->with('success', 'success');;
    }

    public function close(Ticket $ticket)
    {
        $ticket->close();

        return redirect()->back()->with('success', 'success');;
    }

    public function unarchived(Ticket $ticket)
    {
        $ticket->unarchived();

        return redirect()->back()->with('success', 'success');;
    }
}
