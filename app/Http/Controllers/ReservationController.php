<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Repository\Interface\IEventRepository;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReservationController extends Controller
{
    protected $event;

    public function __construct(IEventRepository $event)
    {
        $this->event = $event;
    }

    public function index()
    {
        return view('reservations');
    }

    public function reservation($id)
    {
        $event = $this->event->findById($id);

        if (!$event) {
            return redirect()->back()->with('error', 'Event not found');
        }
        if (!$event->status == 'published') {
            return redirect()->back()->with('error', 'Event is not published');
        }
        if ($event->reserved_seats >= $event->capacity) {
            return redirect()->back()->with('error', 'Event is full');
        }
        if ($event->organizer_id == auth()->id()) {
            return redirect()->back()->with('error', 'You are the organizer of this event');
        }
        $reservation = Reservation::where('event_id', $event->id)->where('user_id', auth()->id())->first();
        if ($reservation) {
            return redirect()->back()->with('error', 'You have already reserved this event');
        }

        if ($event->reservation_approval_mode == 'automatic') {

            $reservation = Reservation::create([
                'event_id' => $event->id,
                'user_id' => auth()->id(),
                'status' => 'approved',
                'reservation_code' => Str::random(10),

            ]);

            $event->reserved_seats += 1;
            $event->save();

            return redirect()->back()->with('success', 'Event reserved successfully.');
        } elseif ($event->reservation_approval_mode == 'manual') {
            $reservation = Reservation::create([
                'event_id' => $event->id,
                'user_id' => auth()->id(),
                'status' => 'pending',
                'reservation_code' => Str::random(10),
            ]);
            return redirect()->back()->with('success', 'Event reserved successfully, you have wait organizer accepted.');
        }
    }


    public function cancel($id)
    {
        $reservation = Reservation::find($id);
        if (!$reservation) {
            return redirect()->back()->with('error', 'Reservation not found');
        }
        if ($reservation->user_id != auth()->id()) {
            return redirect()->back()->with('error', 'You are not authorized to cancel this reservation');
        }

        if ($reservation->status == 'pending') {
            $reservation->delete();
            return redirect()->back()->with('success', 'Reservation canceled successfully.');
        }

        if ($reservation->payment_status == 'paid') {
            return redirect()->back()->with('error', 'You can not cancel this reservation, because you have already paid for it.');
        }

        if ($reservation->status == 'approved') {
            $event = $reservation->event;
            $event->reserved_seats -= 1;
            $event->save();
        }
        $reservation->delete();
        return redirect()->back()->with('success', 'Reservation canceled successfully.');
    }

    public function approve($id)
    {
        $reservation = Reservation::find($id);
        if (!$reservation) {
            return redirect()->back()->with('error', 'Reservation not found');
        }
        if ($reservation->event->organizer_id != auth()->id()) {
            return redirect()->back()->with('error', 'You are not authorized to approve this reservation');
        }
        $reservation->status = 'approved';
        $reservation->save();
        $reservation->event->reserved_seats += 1;
        $reservation->event->save();
        return redirect()->back()->with('success', 'Reservation approved successfully.');
    }

    public function reject($id)
    {
        $reservation = Reservation::find($id);
        if (!$reservation) {
            return redirect()->back()->with('error', 'Reservation not found');
        }
        if ($reservation->event->organizer_id != auth()->id()) {
            return redirect()->back()->with('error', 'You are not authorized to reject this reservation');
        }
        $reservation->status = 'rejected';
        $reservation->save();
        return redirect()->back()->with('success', 'Reservation rejected successfully.');
    }


    public function spectatorReservations()
    {
        $reservations = Reservation::where('user_id', auth()->id())->paginate(10);
        return view('spectator.reservations', compact('reservations'));
    }

    public function organizerReservations()
    {
        $reservations = Reservation::whereIn('event_id', auth()->user()->events->pluck('id'))->where('status', 'pending')->paginate(10);

        return view('organizer.reservations.reservations', compact('reservations'));
    }

    public function approvedReservations()
    {
        $reservations = Reservation::where('status', 'approved')->whereIN('event_id', auth()->user()->events->pluck('id'))->paginate(10);
        return view('organizer.reservations.approved', compact('reservations'));
    }


    public function rejectedReservations()
    {
        $reservations = Reservation::where('status', 'rejected')->whereIN('event_id', auth()->user()->events->pluck('id'))->paginate(10);
        return view('organizer.reservations.rejected', compact('reservations'));
    }

    public function paid()
    {
        $reservations = Reservation::where('payment_status', 'paid')->whereIN('event_id', auth()->user()->events->pluck('id'))->paginate(10);
        return view('organizer.reservations.paid', compact('reservations'));
    }

    // generate a ticket for the user using dompdf
    public function ticket($id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return redirect()->back()->with('error', 'Reservation not found');
        }
        if ($reservation->date < now()) {
            return redirect()->back()->with('error', 'You can not generate a ticket for a past event');
        }
        if ($reservation->user_id != auth()->id()) {
            return redirect()->back()->with('error', 'You are not authorized to view this reservation');
        }

        if ($reservation->status != 'approved') {
            return redirect()->back()->with('error', 'You can only generate a ticket for an approved reservation');
        }

        $pdf = Pdf::loadView('tickets.ticket', compact('reservation'));
        return $pdf->download('ticket.pdf');
    }
}
