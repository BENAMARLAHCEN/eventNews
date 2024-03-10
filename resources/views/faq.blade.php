@extends('layouts.app')

@section('content')
    <div class="max-w-screen-xl mx-auto px-5 bg-white min-h-sceen">
        <div class="flex flex-col items-center">
            <h2 class="font-bold text-5xl mt-5 tracking-tight">
                FAQ
            </h2>
            <p class="text-neutral-500 text-xl mt-3">
                Frequenty asked questions
            </p>
        </div>
    <div class="grid divide-y divide-neutral-200 max-w-xl mx-auto mt-8">
        <div class="py-5">
            <details class="group">
                <summary class="flex justify-between items-center font-medium cursor-pointer list-none">
                    <span> What is the purpose of this platform?</span>
                    <span class="transition group-open:rotate-180">
                        <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24"
                            width="24">
                            <path d="M6 9l6 6 6-6"></path>
                        </svg>
                    </span>
                </summary>
                <p class="text-neutral-600 mt-3 group-open:animate-fadeIn">
                    The purpose of our platform is to provide event organizers with a comprehensive solution for managing and promoting events online.
                </p>
            </details>
        </div>
        <div class="py-5">
            <details class="group">
                <summary class="flex justify-between items-center font-medium cursor-pointer list-none">
                    <span> How does event registration work?</span>
                    <span class="transition group-open:rotate-180">
                        <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24"
                            width="24">
                            <path d="M6 9l6 6 6-6"></path>
                        </svg>
                    </span>
                </summary>
                <p class="text-neutral-600 mt-3 group-open:animate-fadeIn">
                    Event registration is simple and intuitive. Attendees can browse through the available events, select the ones they are interested in, and complete the registration process in just a few clicks.
                </p>
            </details>
        </div>
        <div class="py-5">
            <details class="group">
                <summary class="flex justify-between items-center font-medium cursor-pointer list-none">
                    <span> How can I create an event on this platform?</span>
                    <span class="transition group-open:rotate-180">
                        <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24"
                            width="24">
                            <path d="M6 9l6 6 6-6"></path>
                        </svg>
                    </span>
                </summary>
                <p class="text-neutral-600 mt-3 group-open:animate-fadeIn">
                    To create an event, simply navigate to your dashboard and click on the "Create Event" button. Fill in the required information such as event title, description, date, location, and category, and your event will be live and ready for registration!
                </p>
            </details>
        </div>
        <div class="py-5">
            <details class="group">
                <summary class="flex justify-between items-center font-medium cursor-pointer list-none">
                    <span> Can I customize the registration form for my event?</span>
                    <span class="transition group-open:rotate-180">
                        <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24"
                            width="24">
                            <path d="M6 9l6 6 6-6"></path>
                        </svg>
                    </span>
                </summary>
                <p class="text-neutral-600 mt-3 group-open:animate-fadeIn">
                    Yes, you can customize the registration form to collect specific information from your attendees. Simply go to the event settings page and configure the registration form fields according to your needs.
                </p>
            </details>
        </div>
        <div class="py-5">
            <details class="group">
                <summary class="flex justify-between items-center font-medium cursor-pointer list-none">
                    <span> How do I manage attendee registrations?</span>
                    <span class="transition group-open:rotate-180">
                        <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24"
                            width="24">
                            <path d="M6 9l6 6 6-6"></path>
                        </svg>
                    </span>
                </summary>
                <p class="text-neutral-600 mt-3 group-open:animate-fadeIn">
                    You can manage attendee registrations from your dashboard. View the list of attendees, approve or reject registrations, and communicate with attendees directly through the platform.
                </p>
            </details>
        </div>
		<div class="py-5">
            <details class="group">
                <summary class="flex justify-between items-center font-medium cursor-pointer list-none">
                    <span> How can attendees pay for event registration?</span>
                    <span class="transition group-open:rotate-180">
                        <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24"
                            width="24">
                            <path d="M6 9l6 6 6-6"></path>
                        </svg>
                    </span>
                </summary>
                <p class="text-neutral-600 mt-3 group-open:animate-fadeIn">
                    Attendees can pay for event registration using various payment methods, including credit/debit cards, PayPal, or other online payment gateways. The platform provides a secure payment processing system to ensure smooth transactions.
                </p>
            </details>
        </div>
        <div class="py-5">
            <details class="group">
                <summary class="flex justify-between items-center font-medium cursor-pointer list-none">
                    <span> Is there an option for attendees to cancel their registration?</span>
                    <span class="transition group-open:rotate-180">
                        <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24"
                            width="24">
                            <path d="M6 9l6 6 6-6"></path>
                        </svg>
                    </span>
                </summary>
                <p class="text-neutral-600 mt-3 group-open:animate-fadeIn">
                    Yes, attendees can cancel their registration if they are unable to attend the event. They can do this through their user dashboard by accessing their registration details and following the cancellation process.
                </p>
            </details>
        </div>
        <div class="py-5">
            <details class="group">
                <summary class="flex justify-between items-center font-medium cursor-pointer list-none">
                    <span> Can I send event reminders to registered attendees?</span>
                    <span class="transition group-open:rotate-180">
                        <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24"
                            width="24">
                            <path d="M6 9l6 6 6-6"></path>
                        </svg>
                    </span>
                </summary>
                <p class="text-neutral-600 mt-3 group-open:animate-fadeIn">
                    Yes, you can send event reminders to registered attendees to keep them informed about event details, schedule changes, or important announcements. The platform provides automated reminder emails or notifications that you can customize according to your preferences.
                </p>
            </details>
        </div>
    </div>
@endsection
