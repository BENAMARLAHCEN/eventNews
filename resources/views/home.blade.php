@extends('layouts.app')

@section('content')
 
<div class="h-screen bg-gray-50 flex items-center">
	<section class="bg-cover bg-center py-32 w-full" style="background-image: url('https://source.unsplash.com/random');">
		<div class="container mx-auto text-left text-white">
			<div class="flex items-center">
				<div class="w-1/2">
					<h1 class="text-5xl font-medium mb-6">Welcome to My Agency</h1>
					<p class="text-xl mb-12">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra
						euismod odio, gravida pellentesque urna varius vitae.</p>
					<a href="#" class="bg-indigo-500 text-white py-4 px-12 rounded-full hover:bg-indigo-600">Demo</a>
				</div>
				<div class="w-1/2 pl-16">
					<img src="https://source.unsplash.com/random?ux" class="h-64 w-full object-cover rounded-xl" alt="Layout Image">
      </div>
				</div>
			</div>
	</section>
</div>



<div id="place_result" class="flex flex-wrap lg:px-10 px-8 gap-2 md:justify-center pb-10 pt-2 justify-center w-full">
    @foreach ($events as $event)
        <x-event-card :event="$event" />
    @endforeach
</div>

@endsection