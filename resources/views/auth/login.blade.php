@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex items-center justify-center w-full dark:bg-gray-950">
        <div class="bg-white dark:bg-gray-900 shadow-md rounded-lg px-8 py-6 max-w-md">
            <div class="flex justify-center mb-4">
                <a href="/" class="flex items-center whitespace-nowrap text-2xl font-black">
                    <span class="mr-2 w-9">
                        <img src="{{ asset('images/event (2).png') }}" alt="logo" />
                    </span>
                    Event News
                </a>
            </div>
            <h1 class="text-2xl font-bold text-center mb-4 dark:text-gray-200">Welcome Back!</h1>
            <form action="{{ route('login') }}" method="POST" id="logunForm">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email
                        Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="your@email.com" required>
                    <p id="emailError" class="text-red-500 text-xs italic hidden"></p>
                    @error('email')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Password</label>
                    <input type="password" id="password" name="password"
                        class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Enter your password" required>
                    <p id="passwordError" class="text-red-500 text-xs italic hidden"></p>
                    @error('password')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                    <a href="{{ route('forget.password.get') }}"
                        class="text-xs text-gray-600 hover:text-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Forgot
                        Password?</a>
                </div>
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <input type="checkbox" id="remember"
                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 focus:outline-none"
                            checked>
                        <label for="remember" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">Remember
                            me</label>
                    </div>
                    <a href="{{ route('register') }}"
                        class="text-xs text-indigo-500 hover:text-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Create
                        Account</a>
                </div>
                <button type="submit"
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Login</button>
            </form>

            <script>
                document.getElementById('logunForm').addEventListener('submit', function(event) {
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

                    var passwordInput = document.getElementById('password');
                    if (passwordInput.value.trim() === '') {
                        document.getElementById('passwordError').innerText = 'Password is required';
                        document.getElementById('passwordError').classList.remove('hidden');
                        passwordInput.focus();
                        isValid = false;
                    } else if (passwordInput.value.trim().length < 6) {
                        document.getElementById('passwordError').innerText = 'Password must be at least 6 characters long';
                        document.getElementById('passwordError').classList.remove('hidden');
                        passwordInput.focus();
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
