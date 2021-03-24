<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row w-full items-center">
        <h2 class="flex-grow font-semibold text-xl text-gray-800 leading-tight">
            {{ __('tags.agent') }}
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
                        <a href="{{ route('agents.create') }}" class="bg-green-600 hover:bg-green-700 rounded-md text-white py-2 px-4 font-bold">
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
                                    {{ __('tags.name') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('tags.action') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($agents as $agent)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                    {{ $agent->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500 flex justify-center">
                                    <div class="pill bg-red-400 text-black rounded-full px-4 text-xs mr-2  py-1">
                                        <a class="btn btn-primary" href="{{ route('agents.edit',$agent->id) }}">{{ __('tags.edit') }}</a>
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
