<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row w-full items-center">
        <h2 class="flex-grow font-semibold text-xl text-gray-800 leading-tight">
            {{ trans_choice('tags.role', 2) }}
        </h2>
        <a href="{{ route('admin.index') }}" class="text-sm text-gray-700 underline">{{ __('tags.return') }}</a>
        </div>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-message-card/>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex justify-end pb-5">
                    <div class="flex justify-end pb-5">
                        @can('role-create')
                        <a href="{{ route('roles.create') }}" class="bg-green-600 hover:bg-green-700 rounded-md text-white py-2 px-4 font-bold">
                            <x-heroicon-o-plus-circle class="w-10 h-10"/>
                            <p>{{ __('tags.create') }}</p>
                        </a>
                        @endcan
                    </div>
                </div>
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Nombre') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Action') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($roles as $role)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                    {{ $role->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500 flex justify-center">
                                    <div class="pill bg-red-400 text-black rounded-full px-4 text-xs mr-2  py-1">
                                        <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">{{ __('tags.edit') }}</a>
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
