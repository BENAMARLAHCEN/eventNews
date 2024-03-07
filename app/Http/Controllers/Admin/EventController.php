<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Repository\Interface\IEventRepository;
use Illuminate\Http\Request;

class EventController extends Controller
{
    protected $eventRepository;

    public function __construct(IEventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    // admin dosen't create event he just accept or 
    public function index()
    {
        $events = $this->eventRepository->listPending();
        return view('admin.events.index', compact('events'));
    }


    public function published()
    {
        $events = $this->eventRepository->listPublished();
        return view('admin.events.published', compact('events'));
    }

    public function rejected()
    {
        $events = $this->eventRepository->listRejected();
        return view('admin.events.rejected', compact('events'));
    }

    public function accept($id)
    {
        $this->eventRepository->accepte($id);
        return redirect()->back()->with('success', 'Event accepted successfully.');
    }

    public function reject($id)
    {
        $this->eventRepository->reject($id);
        return redirect()->back()->with('success', 'Event rejected successfully.');
    }

    
}
