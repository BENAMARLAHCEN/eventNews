@extends('layouts.dachboard')

@section('content')

<!-- Start coding here -->
<div class="bg-white dark:bg-gray-800 relative  shadow-md sm:rounded-lg overflow-hidden">
    <div class="relative p-4 bg-white rounded-lg shadow  dark:bg-gray-800 sm:p-5">
        <!-- Modal header -->
        <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                Add Event</h3>
        </div>
        <!-- Modal body -->
        <form action="{{ route('organizer.events.store') }}" method="POST" enctype="multipart/form-data" id="createEventForm">
            @csrf
            @method('post')
            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                <input type="hidden" name="status" value="Pending">
                <input type="hidden" name="tickets_booked" value="0">
                <div>
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Title
                    </label>
                    <input type="text" name="title" id="title"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500"
                        placeholder="Title" required="">
                    <x-input-error :error="'title'" class="mt-2" />
                </div>

                <div>
                    <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Date
                    </label>
                    <input type="datetime-local" name="date" id="date"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500"
                        required="">
                    <x-input-error :error="'date'" class="mt-2" />
                </div>
                <div>
                    <label for="location" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Location
                    </label>
                    <input type="text" name="location" id="location"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500"
                        placeholder="Location" required="">
                    <x-input-error :error="'location'" class="mt-2" />
                </div>

                <div>
                    <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Image
                    </label>
                    <input type="file" name="image" id="image"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500"
                        placeholder="Image URL" required="">
                    <x-input-error :error="'image'" class="mt-2" />
                </div>

                <div>
                    <label for="places_available" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Places Available
                    </label>
                    <input type="number" name="capacity" id="places_available"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500"
                        placeholder="Places Available" required="">
                    <x-input-error :error="'places_available'" class="mt-2" />
                </div>

                <div>
                    {{-- <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Price ($)
                    </label>
                    <input type="number" name="price" id="price"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500"
                        placeholder="Price" required="">
                    <x-input-error :error="'price'" class="mt-2" /> --}}
                </div>

                <div>
                    <label for="reservation_approval_mode" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Type Reservation
                    </label>
                    <select name="reservation_approval_mode" id="reservation_approval_mode"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500"
                        required="">
                        <option selected disabled value="manual">Select Type Reservation</option>
                        <option value="manual">Manual</option>
                        <option value="automatic">Automatic</option>
                    </select>
                    <x-input-error :error="'reservation_approval_mode'" class="mt-2" />
                </div>

                <div>
                    <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Category
                    </label>

                    <select name="category_id" id="category_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500">
                        <option selected disabled>Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :error="'category_id'" class="mt-2" />
                </div>

            </div>
            <div>
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Description
                </label>
                <textarea name="description" id="description"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500"
                    rows="4" placeholder="Description" required=""></textarea>
                <x-input-error :error="'description'" class="mt-2" />
            </div>

            <button type="submit"
                class="text-white inline-flex items-center mt-2 bg-orange-500 hover:bg-orange-500/85 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-orange-500 dark:hover:bg-orange-600 dark:focus:ring-orange-600">
                <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
                Create
            </button>
        </form>
    </div>
</div>

@endsection