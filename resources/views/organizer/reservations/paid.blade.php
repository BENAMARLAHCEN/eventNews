@extends('layouts.dachboard')

@section('content')
    <h3 class="text-3xl font-medium text-gray-700">Reservation</h3>
    <div class="mt-8">

    {{-- published and rejected link --}}
    <a href="{{ route('reservations.organizer') }}"
    class="px-4 py-2 text-sm font-medium leading-5 text-white bg-yellow-500 border border-transparent rounded-md hover:bg-yellow-400 focus:outline-none focus:border-yellow-700 focus:shadow-outline-yellow active:bg-yellow-700 transition duration-150 ease-in-out">Pending</a>
        <a href="{{ route('reservations.approved') }}"
            class="px-4 py-2 text-sm font-medium leading-5 text-white bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">Approved</a>
        <a href="{{ route('reservations.rejected') }}"
            class="px-4 py-2 text-sm font-medium leading-5 text-white bg-red-600 border border-transparent rounded-md hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-700 transition duration-150 ease-in-out">Rejected</a>

    </div>

    <div class="flex flex-col mt-8">
        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Event</th>

                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Spectator</th>
                            
                            
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                        </tr>
                    </thead>

                    <tbody class="bg-white">
                        @foreach ($reservations as $reservation)
                            <tr>
                       


                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-15 h-18">
                                            <img class="w-10 h-10" src=" {{ asset('events/' . $reservation->event->image) }} "
                                                alt="">
                                        </div>

                                        <div class="ml-4">
                                            <div class="text-sm font-medium leading-5 text-gray-900">
                                                {{ $reservation->event->title }}</div>
                                        </div>

                                    </div>

                                </td>

                                <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">

                                    <div class="text-sm">
                                        <div class="font-medium text-gray-700">{{ $reservation->user->name }}</div>
                                        <div class="text-gray-400">{{ $reservation->user->email }}</div>
                                    </div>
                                </th>
                           
                                <td
                                    class="px-6 py-4 text-sm font-medium leading-5 text-right whitespace-no-wrap border-b border-gray-200">
                                    <div class="flex item-center justify-center">

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    {{ $reservations->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
