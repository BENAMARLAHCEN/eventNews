@extends('layouts\dachboard')

@section('content')
    <!-- Start coding here -->
    <div class="bg-white dark:bg-gray-800 relative  shadow-md sm:rounded-lg overflow-hidden">
        <div class="relative p-4 bg-white rounded-lg shadow  dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Edit User Access</h3>
            </div>
            <!-- Modal body -->
            <form action="{{ route('users.restrict.access', $user->id) }}" method="POST" enctype="multipart/form-data"
                id="createEventForm" method="POST">
                @csrf
                @method('put')
                <div class=" gap-4 mb-4 sm:grid-cols-2">
                    <input type="hidden" name="status" value="Pending">
                    <input type="hidden" name="tickets_booked" value="0">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Name
                        </label>
                        <input type="text" name="name" id="name" value="{{ $user->name }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500"
                            placeholder="name" disabled>

                        <x-input-error :error="'name'" class="mt-2" />
                    </div>
                    <div>
                        <div class="flex gap-2 my-4">
                            @foreach ($user->userPermissions() as $permission)
                                <span
                                    class="inline-flex items-center gap-1 rounded-full bg-blue-50 px-2 py-1 text-xs font-semibold text-blue-600">
                                    {{ $permission}}
                                </span>
                            @endforeach
                        </div>
                     
                    </div>

                    <div>
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                           Blocked Permission
                        </label>
                        <select id="select-permissions" name="permissions[]" multiple placeholder="Select a permission..."
                            autocomplete="off">
                            @foreach ($permissions as $permission)
                                <option value="{{ $permission->name }}" @if ($user->hasBlockedPermission($permission->name))
                                    selected
                                    
                                @endif>{{ $permission->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :error="'permissions'" class="mt-2" />

                    </div>

                    <button type="submit"
                        class="text-white inline-flex items-center mt-2 bg-orange-500 hover:bg-orange-500/85 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-orange-500 dark:hover:bg-orange-600 dark:focus:ring-orange-600">
                        <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Update
                    </button>
            </form>
        </div>
    </div>
@endsection
