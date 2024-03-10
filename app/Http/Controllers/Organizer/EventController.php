<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Http\Requests\updateEventRequest;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Repository\Interface\IEventRepository;

class EventController extends Controller
{
    protected $event;

    public function __construct(IEventRepository $event)
    {
        $this->event = $event;
    }

    public function index()
    {
        // $this->authorize('viewAny', Event::class);

        $events = $this->event->listByUser(auth()->id());

        return view('organizer.events.index', compact('events'));
    }

    public function show($id)
    {
        $event = $this->event->findById($id);
        
        return view('details', compact('event'));
    }

    public function create()
    {
        $this->authorize('create', Event::class);
        $categories = Category::all();
        return view('organizer.events.create', compact('categories'));
    }

    public function store(EventRequest $request)
    {
        $this->authorize('create', Event::class);
        $data = $request->validated();
        $imageName = time() . '.' . $request->image->extension();
        $data['image'] = $imageName;
        $data['organizer_id'] = auth()->id();
        
        $this->event->storeOrUpdate($data);

        $request->image->move(public_path('events'), $imageName);

        return redirect()->route('organizer.events.index')->with('success', 'Event created successfully.');
    }

    public function edit($id)
    {
        $event = $this->event->findById($id);

        $this->authorize('update', $event);
        $categories = Category::all();

        return view('organizer.events.edit', compact('event', 'categories'));
    }

    public function update(updateEventRequest $request, $id)
    {

        $event = $this->event->findById($id);

        $this->authorize('update', $event);
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $data['image'] = $imageName;
            $this->event->storeOrUpdate($data, $id);
            $request->image->move(public_path('events'), $imageName);
        } else {
            unset($data['image']);
            $this->event->storeOrUpdate($data, $id);
        }

        return redirect()->route('organizer.events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy($id)
    {
        $event = $this->event->findById($id);

        $this->authorize('delete', $event);

        $this->event->destroyById($id);

        return redirect()->route('organizer.events.index')->with('success', 'Event deleted successfully.');
    }
}
