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