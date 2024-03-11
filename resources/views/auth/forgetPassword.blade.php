@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex items-center justify-center w-full dark:bg-gray-950">
        <div class="bg-white dark:bg-gray-900 shadow-md rounded-lg px-8 py-6 max-w-md" style="min-width: 35%;">
            <div class="flex justify-center mb-4">
                <a href="/" class="flex items-center whitespace-nowrap text-2xl font-black">
                    <span class="mr-2 w-9">
                        <img src="{{ asset('images/event (2).png') }}" alt="logo" />
                    </span>
                    Event News
                </a>
            </div>
            <h1 class="text-2xl font-bold text-center mb-4 dark:text-gray-200">Forgot Password</h1>
            <form id="forget" action="{{ route('forget.password.post') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email
                        Address</label>
                    <input type="email" id="email" name="email"
                        class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="your@email.com" required>
                    <p id="emailError" class="text-red-500 text-xs italic hidden"></p>

                    @error('email')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit"
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Send
                    Password Reset Link</button>
            </form>
            <script>
                document.getElementById('forget').addEventListener('submit', function(event) {
                    var isValid = true;

                    document.querySelectorAll('.error-message').forEach(function(element) {
                        element.classList.add('hidden');
                    });

                    var emailInput = document.getElementById('email');
                    if (emailInput.value.trim() === '') {
                        document.getElementById('emailError').innerText = 'Email is required';
                        document.getElementById('emailError').classList.remove('hidden');
                        emailInput.focus();
                        isValid = false;
                    } else if (!isValidEmail(emailInput.value.trim())) {
                        document.getElementById('emailError').innerText = 'Please enter a valid email address';
                        document.getElementById('emailError').classList.remove('hidden');
                        emailInput.focus();
                        isValid = false;
                    }

                    if (!isValid) {
                        event.preventDefault();
                    }

                    return isValid;
                });

                function isValidEmail(email) {
                    var emailRegex = /\S+@\S+\.\S+/;
                    return emailRegex.test(email);
                }
            </script>
        </div>
    </div>
@endsection
