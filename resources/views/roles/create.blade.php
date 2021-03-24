<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ trans_choice('tags.user', 2) }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-message-card/>

<div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
    <div class="relative py-3 sm:max-w-xl sm:mx-auto">
        <div class="relative px-4 py-10 bg-white mx-8 md:mx-0 shadow rounded-3xl sm:p-10">
            <div class="max-w-md mx-auto">
                <x-message-card/>
                <x-error-list/>
                <div class="flex items-center space-x-5">
                    <div
                        class="h-14 w-14 bg-yellow-200 rounded-full flex flex-shrink-0 justify-center items-center text-yellow-500 text-2xl font-mono">
                        i</div>
                    <div class="block pl-2 font-semibold text-xl self-start text-gray-700">
                        <h2 class="leading-relaxed">{{ __('Create a Role') }}</h2>
                        <p class="text-sm text-gray-500 font-normal leading-relaxed">{{ __('Crear un rol para la aplicación') }}</p>
                    </div>
                </div>
                <form action="{{ route('roles.store') }}" method="post">
                    {{ csrf_field() }}
                    <div class="divide-y divide-gray-200">
                        <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                            <div class="flex flex-col">
                                <label class="leading-loose">{{ __('tags.name') }}</label>
                                <input type="text" name="name"
                                    class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                                    placeholder="{{ __('tags.name') }}">
                            </div>
                            <div class="flex flex-col">
                                <label class="leading-loose">{{ trans_choice('tags.role', 2) }}</label>
                                <select name="permissions[]" id="permissions" class="bg-white text-gray-900 appearance-none border-none inline-block py-3 pl-3 pr-8 rounded leading-tight w-full" multiple>
                                    @foreach($permissions as $permission)
                                        <option value="{{ $permission->id }}" class="pt-6">{{ $permission->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="pt-4 flex items-center space-x-4">
                            <button
                                class="flex justify-center items-center w-full text-gray-900 px-4 py-3 rounded-md focus:outline-none">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg> {{ __('tags.cancel') }}
                            </button>
                            <button type="submit"
                                class="bg-blue-500 flex justify-center items-center w-full text-white px-4 py-3 rounded-md focus:outline-none">{{ __('tags.create') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</x-app-layout>
