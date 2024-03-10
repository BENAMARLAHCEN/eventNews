@props(['event'])
<a href="{{ route('events.show', $event) }}"
    class="hover:scale-[101%] bg-white dark:bg-slate-800 m-2 rounded-lg overflow-hidden shadow-lg ring-4 ring-violet-500 ring-opacity-40 max-w-sm w-full md:w-[30%] flex flex-col justify-between">
    <div class="relative w-full  dark:text-gray-300">
        <img class="w-full object-cover max-h-56"
            src="{{ asset('events/' . $event->image) }}"
            alt="Product Image">
        <div class="p-2">
            <div class="absolute top-0 right-0 bg-blue-500 text-white px-2 py-1 m-2 rounded-md text-sm font-medium">
                {{ \Carbon\Carbon::parse($event->date)->format('d M, Y') }}
            </div>
            <h3 class="text-lg dark:text-gray-200 font-medium mb-2">{{ $event->title }}</h3>
            <p class="text-gray-600 text-sm mb-4 dark:text-gray-300">{{ Str::limit($event->description, 80, '...') }}</p>
            <span
                class="font-medium mb-2 bg-gray-200 dark:bg-gray-600 p-1 rounded-md">{{ $event->category->name }}</span>
        </div>
    </div>
    <div class="p-4">
        <div class="flex items-end mt-4 justify-between">
            <span class="flex items-center gap-1">
                <span>
                    <svg class="w-5 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                    id="ticket">
                    <path
                        d="m4.906 11.541 3.551 3.553 6.518-6.518-3.553-3.551-6.516 6.516zm14.198-4.877-1.511-1.512a2.024 2.024 0 0 1-2.747-2.746L13.335.894a1.017 1.017 0 0 0-1.432 0L.893 11.904a1.017 1.017 0 0 0 0 1.432l1.512 1.51a2.024 2.024 0 0 1 2.747 2.748l1.512 1.51a1.015 1.015 0 0 0 1.432 0L19.104 8.096a1.015 1.015 0 0 0 0-1.432zM8.457 16.719l-5.176-5.178L11.423 3.4l5.176 5.176-8.142 8.143z">
                    </path>
                </svg>
                </span>
                <span class="font-bold p-0 text-lg dark:text-gray-200">{{ $event->price }}$</span>
            </span>
            <span class="mt-3 text-indigo-500 inline-flex items-center">More Details
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                </svg>
            </span>
        </div>
    </div>
</a>
