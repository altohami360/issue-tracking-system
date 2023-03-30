<?php

namespace App\Http\Controllers;

use App\Enums\Priority;
use App\Enums\TicketStatus;
use App\Enums\UserRole;
use App\Events\NewTicket;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\Category;
use App\Models\Label;
use App\Models\Message;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $term = $request->term ?? null;

        $status = TicketStatus::cases();

        $priority = Priority::cases();

        $tickets = Ticket::with(['labels', 'categories', 'user'])
            ->search($term)
            ->latest()
            ->paginate(10);

        return view('tickets.index', compact('tickets', 'status', 'priority', 'term'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $labels = Label::all();

        $categories = Category::all();

        $priority = Priority::cases();

        $roles = UserRole::cases();

        return view('tickets.create', compact('labels', 'categories', 'priority', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request)
    {
        $validated = $request->validated();

        $ticket = Ticket::create($validated);

        $ticket->categories()->attach($request->categories);

        $ticket->labels()->attach($request->labels);

        NewTicket::dispatch($ticket);

        return to_route('tickets.index')->with('success', 'success');;
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        $ticket->open();

        $ticket = $ticket->load(['labels', 'categories']);

        $messages = Message::where('ticket_id', '=', $ticket->id)->get();

        return view('tickets.show', compact('ticket', 'messages'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        $ticket = $ticket->load(['labels', 'categories']);

        $categories = Category::categoriesInTicketChecked($ticket->categories);

        $labels = Label::all();

        $priority = Priority::cases();

        $roles = UserRole::cases();

        return view('tickets.edit', compact('ticket', 'labels', 'categories', 'priority', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        $validated = $request->validated();

        $ticket->update($validated);

        if ($request->has('categories')) {
            $ticket->categories()->sync($request->categories);
        }

        if ($request->has('labels')) {
            $ticket->labels()->sync($request->labels);
        }

        return to_route('tickets.index')->with('success', 'success');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return to_route('tickets.index')->with('success', 'success');
    }
}
