
@if (count($events) == 0)
    @include('test.no-results')
@else
@foreach ($events as $event)
    <x-event-card :event="$event" />
@endforeach
@endif
