<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Mollie\Laravel\Facades\Mollie;

class MollieController extends Controller
{
    public function mollie($id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return redirect()->back()->with('error', 'This reservation is not exist.');
        }
        if ($reservation->user_id != Auth::id()) {
            return redirect()->back()->with('error', 'You are not authorized to make payment for this reservation.');
        }
        if ($reservation->payment_status == 'paid') {
            return redirect()->back()->with('error', 'This reservation is already paid.');
        }
        if ($reservation->status != 'approved') {
            return redirect()->back()->with('error', 'You can not make payment for this reservation, because it is not approved yet.');
        }
        if ($reservation->event->date < Carbon::now()) {
            return redirect()->back()->with('error', 'You can not make payment for this reservation, because the event is already finished.');
        }
        if ($reservation->event->reserved_seats - 1 >= $reservation->event->capacity) {
            return redirect()->back()->with('error', 'You can not make payment for this reservation, because the event is already full.');
        }

        $totalAmount = $reservation->event->price;
        $totalAmount = number_format($totalAmount, 2, '.', '');
        $payment = Mollie::api()->payments->create([
            "amount" => [
                "currency" => "USD",
                "value" => $totalAmount,
            ],
            "description" => "product_name",
            "redirectUrl" => route('success'),
        ]);

        //dd($payment);

        session()->put('paymentId', $payment->id);
        session()->put('reservationID',$id);
        // redirect customer to Mollie checkout page
        return redirect($payment->getCheckoutUrl(), 303);
    }

    public function success(Request $request)
    {
        $paymentId = session()->get('paymentId');
        $payment = Mollie::api()->payments->get($paymentId);
        $id = session()->get('reservationID');
        if ($payment->isPaid()) {

            $reservation = Reservation::find($id);

            $reservation->payment_status = 'paid';
            $reservation->save();

            session()->forget('paymentId');
            session()->forget('reservationID');

            return redirect()->route('reservations.spectator')->with('success', 'your reservation is completed');
        } else {
            return redirect()->route('cancel');
        }
    }

    public function cancel()
    {
        return redirect()->route('reservations.spectator')->with('error','Payment is cancelled.');
    }

}