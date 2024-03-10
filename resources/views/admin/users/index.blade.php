@extends('layouts.dachboard')

@section('content')
    <h3 class="text-3xl font-medium text-gray-700">
        Events</h3>
    <div class="mt-8">

    </div>

    <div class="flex flex-col mt-8">
        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Name</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Role</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Permission</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 border-t border-gray-100">

                        @foreach ($users as $user)
                            <tr class="hover:bg-gray-50">
                                <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">

                                    <div class="text-sm">
                                        <div class="font-medium text-gray-700">{{ $user->name }}</div>
                                        <div class="text-gray-400">{{ $user->email }}</div>
                                    </div>
                                </th>

                                <td class="px-6 py-4 ">
                                    @foreach ($user->roles as $role)
                                        <div 
                                            class="inline-flex items-center gap-1 rounded-full bg-blue-50 px-2 py-1 text-xs font-semibold text-blue-600">
                                            {{ $role->name }}
                                        </div>
                                    @endforeach
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="flex gap-2">
                                        @foreach ($user->userPermissions() as $permission)
                                            <span
                                                class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-indigo-500 rounded-full">
                                                {{ $permission }}
                                            </span>
                                        @endforeach

                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-end gap-4">
                                        <a href="{{route('users.access',$user->id)}}" class="flex"><i class="fa-solid fa-hand"></i><i class="fa-solid fa-key"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="m-4">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
