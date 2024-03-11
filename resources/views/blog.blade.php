@extends('layouts.app')

@section('content')


    <!-- hero headline -->
    <div class="hero-headline flex flex-col items-center justify-center pt-24 text-center">
        <h1 class="font-bold text-3xl text-gray-900">Welcome to Event News</h1>
        <p class="font-base text-base text-gray-600">Discover amazing content and stay updated with the latest news and
            events.</p>
    </div>

    <!-- image search box -->
    <div class="box pt-6">
        <div class="box-wrapper px-7">

            <div class=" bg-white rounded flex items-center w-full p-3 shadow-sm border border-gray-200">
                <button class="outline-none focus:outline-none"><svg class=" w-5 text-gray-600 h-5 cursor-pointer"
                        fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg></button>
                <input type="search" name="" id="search" oninput="searchAndFilter()"
                    placeholder="search for event"
                    class="w-full pl-4 text-sm outline-none focus:outline-none bg-transparent">

            </div>

        </div>
    </div>


    <div class="container mx-auto flex flex-wrap py-6">



        <!-- Sidebar Section -->
        <aside class="w-full md:w-1/5 flex flex-col items-center px-3">

            <div class="w-full bg-white shadow flex flex-col my-4 p-6">
                <div class=" lg:block">
                    <h3 class="mb-3">Categories:</h3>

                    <ul role="list" class="space-y-4 border-b border-gray-200 pb-6 text-sm font-medium text-gray-900">
                        @if (!empty($categories))
                            @foreach ($categories as $category)
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                        class="custom-control-input category_checkbox" id="{{ $category->id }}">
                                    <label class="custom-control-label"
                                        for="{{ $category->id }}">{{ ucfirst($category->name) }}</label>
                                </div>
                            @endforeach
                        @endif

                    </ul>

                </div>
            </div>



        </aside>

        <!-- Posts Section -->

        <section class="w-full md:w-4/5 flex flex-col items-center px-3">

            <div id="place_result"
                class="flex flex-wrap lg:px-10 px-8 gap-2 md:justify-center pb-10 pt-2 justify-center w-full">
                @foreach ($events as $event)
                    <x-event-card :event="$event" />
                @endforeach
            </div>

            {{ $events->links() }}

        </section>
    </div>

    <script>
        
        document.addEventListener('DOMContentLoaded', function() {
            var categoryCheckboxes = document.querySelectorAll('.category_checkbox');
            var searchInput = document.getElementById('search');

            categoryCheckboxes.forEach(function(checkbox) {
                checkbox.addEventListener('click', function() {
                    searchAndFilter();
                });
            });

            searchInput.addEventListener('keyup', function() {
                searchAndFilter();
            });
        });

        function searchAndFilter() {
            var category = [];
            var categoryCheckboxes = document.querySelectorAll('.category_checkbox');

            categoryCheckboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    category.push(checkbox.getAttribute('id'));
                }
            });

            if (category.length === 0) {
                categoryCheckboxes.forEach(function(checkbox) {
                    category.push(checkbox.getAttribute('id'));
                });
            }

            category = category.join(',');
            console.log(category);

            var searchValue = document.getElementById('search').value;

            var xhr = new XMLHttpRequest();
            xhr.open('GET', "{{ route('search') }}?search=" + encodeURIComponent(searchValue) + "&categories=" + category);
            xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.getElementById('place_result').innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }
    </script>


@endsection
