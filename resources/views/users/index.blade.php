<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ trans_choice('tags.user', 2) }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-message-card/>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex justify-end pb-5">
                    <div class="flex justify-end pb-5">
                        <a href="{{ route('roles.index') }}" class="bg-blue-600 hover:bg-blue-700 rounded-md text-white py-2 px-4 font-bold">
                            <x-heroicon-o-plus-circle class="w-10 h-10"/>
                            <p>{{ trans_choice('tags.role', 2) }}</p>
                        </a>
                    </div>
                    <div class="flex justify-end pb-5">
                        <a href="{{ route('users.create') }}" class="bg-green-600 hover:bg-green-700 rounded-md text-white py-2 px-4 font-bold">
                            <x-heroicon-o-plus-circle class="w-10 h-10"/>
                            <p>{{ __('tags.create') }}</p>
                        </a>
                    </div>
                </div>
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('tags.username') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('tags.name') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('tags.email') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ trans_choice('role', 2) }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Action') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($users as $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                    {{ $user->username }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                    {{ $user->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                    {{ $user->email }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                    @if(!empty($user->getRoleNames()))
                                        @foreach($user->getRoleNames() as $v)
                                        <label class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-gren-100 bg-green-600 rounded-full">{{ $v }}</label>
                                        @endforeach
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500 flex justify-center">
                                    <div class="pill bg-green-400 text-black rounded-full px-4 text-xs mr-2  py-1">
                                        <a href="{{ route('users.show',$user->id) }}">Show</a>
                                    </div>
                                    <div class="pill bg-red-400 text-black rounded-full px-4 text-xs mr-2  py-1">
                                        <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
