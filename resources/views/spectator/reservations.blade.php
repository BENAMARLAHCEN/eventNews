@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-semibold mb-4">My Reservations</h1>
    <div class="bg-white rounded-lg shadow-md p-6 mb-4">
        @if ($reservations->isEmpty())
            <p class="text-gray-500">You have no reservations.</p>
        @else
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="text-left font-semibold">Event</th>
                        <th class="text-left font-semibold">Status</th>
                        <th class="text-left font-semibold">Payment Status</th>
                        <th class="text-left font-semibold">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reservation)
                        <tr>
                            <td class="py-4">
                                <div class="flex items-center">
                                <img class="h-16 w-16 mr-4" src="{{asset('events/'.$reservation->event->image)}}" alt=" image">
                                <span class="font-semibold">{{ $reservation->event->title }}</span>
                            </div>
                        </td>
                            <td class="py-4">{{ $reservation->status }}</td>
                            <td class="py-4">{{ $reservation->payment_status }}</td>
                            <td class="py-4">
                                {{-- @if ($reservation->status == 'approved' && $reservation->payment_status == 'unpaid')
                                    <a href="{{ route('reservations.pay', $reservation->id) }}" class="bg-blue-500 text-white py-1 px-4 rounded-md">Pay</a>
                                @endif --}}
                                @if ($reservation->status == 'approved' && $reservation->payment_status == 'paid')
                                    <a href="{{ route('tickets.generate', $reservation->id) }}" class="bg-green-500 text-white py-1 px-4 rounded-md">View Ticket</a>
                                @endif
                                @if ($reservation->payment_status == 'unpaid' && $reservation->status != 'rejected' && $reservation->status != 'pending')
                                    <form action="{{ route('reservations.payment', $reservation->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-blue-500 text-white py-1 px-4 rounded-md">Pay</button>
                                    </form>
                                @endif

                                @if ($reservation->status == 'rejected')

                                    <form action="{{ route('reservations.cancel', $reservation->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white py-1 px-4 rounded-md">Remove</button>
                                    </form>
                                    <p class="text-red-500 font-semibold">This reservation is rejected by the event organizer. Please remove it.</p>
                                @endif

                                @if ($reservation->status != 'rejected' && $reservation->payment_status == 'unpaid')
                                <form action="{{ route('reservations.cancel', $reservation->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white py-1 px-4 rounded-md">Cancel</button>
                                </form>
                                @endif
                            
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection