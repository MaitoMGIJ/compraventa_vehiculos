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
                <div class="flex items-center space-x-5">
                    <div
                        class="h-14 w-14 bg-yellow-200 rounded-full flex flex-shrink-0 justify-center items-center text-yellow-500 text-2xl font-mono">
                        i</div>
                    <div class="block pl-2 font-semibold text-xl self-start text-gray-700">
                        <h2 class="leading-relaxed">{{ __('Show User') }}</h2>
                        <p class="text-sm text-gray-500 font-normal leading-relaxed">
                            <a href="{{ route('users.index') }}" class="text-sm text-gray-700 underline">{{ __('tags.return') }}</a>
                        </p>
                    </div>
                </div>
                <form action="{{ route('users.store') }}" type="post">
                    <div class="divide-y divide-gray-200">
                        <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                            <div class="flex flex-col">
                                <label class="leading-loose">{{ __('tags.username') }}</label>
                                <label class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">
                                    {{ $user->username }}
                                </label>
                            </div>
                            <div class="flex flex-col">
                                <label class="leading-loose">{{ __('tags.name') }}</label>
                                <label class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">
                                    {{ $user->name }}
                                </label>
                            </div>
                            <div class="flex flex-col">
                                <label class="leading-loose">{{ __('tags.email') }}</label>
                                <label class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">
                                    {{ $user->email }}
                                </label>
                            </div>
                            <div class="flex flex-col">
                                <label class="leading-loose">{{ trans_choice('tags.role', 2) }}</label>
                                    @if(!empty($user->getRoleNames()))
                                        @foreach($user->getRoleNames() as $v)
                                            <label class="pill bg-green-400 text-black rounded-full px-4 text-xs mr-2  py-1">{{ $v }}</label>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
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
