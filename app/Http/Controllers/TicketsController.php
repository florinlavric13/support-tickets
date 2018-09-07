<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Ticket;
use App\Mailers\AppMailer;

class TicketsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * This function from controller create a new ticket.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public  function create() {

        $categories = Category::all();
        $view = view('tickets.create', compact('categories'));

        return $view;
    }

    public function store(Request $request, AppMailer $mailer)
    {
        $this->validate($request, [
            'title'    => 'required',
            'category' => 'required',
            'priority' => 'required',
            'message'  => 'required'
        ]);

        $ticket = new Ticket([
            'title' => $request->input('title'),
            'user_id' => Auth::user()->id,
            'ticket_id' => strtoupper(str_random(10)),
            'category_id'  => $request->input('category'),
            'priority'  => $request->input('priority'),
            'message'   => $request->input('message'),
            'status'    => "Open",

        ]);

        $ticket->save();

        $mailer->sendTicketInformation(Auth::user(), $ticket);
        $redirect = redirect()->back()->with("status", "A ticket with ID: #$ticket->ticket_id has been opened.");

        return $redirect;
    }

    public function userTickets()
    {
        $tickets    = Ticket::where('user_id', Auth::user()->id)->paginate(10);
        $categories = Category::all();
        $view       = view('tickets.user_tickets', compact('tickets', 'categories'));

        return $view;

    }

    public function show($ticket_id)
    {
        $ticket   = Ticket::where('ticket_id', $ticket_id)->firstOrFail();
        $comment = $ticket->comments;

        $category = $ticket->category;
        $view     = view('tickets.show', compact('ticket', 'category', 'comment'));

        return $view;
    }

    public function index()
    {
        $tickets = Ticket::paginate(10);
        $categories = Category::all();

        return view('tickets.index', compact('tickets', 'categories'));
    }

    public function close($ticket_id, AppMailer $mailer)
    {
        $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();

        $ticket->status = 'Closed';

        $ticket->save();

        $ticketOwner = $ticket->user;

        $mailer->sendTicketStatusNotification($ticketOwner, $ticket);

        return redirect()->back()->with("status", "The ticket has been closed.");
    }
}
