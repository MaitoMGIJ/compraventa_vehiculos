<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('tags.administration') }}
        </h2>
    </x-slot>

    <style>
        .dark{color:rgba(55, 65, 81,1);}
        body{background:white !important;}
      </style>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
        <div class="bg-transparent overflow-hidden shadow-xl sm:rounded-lg">
            <div class="holder">

                <div class="card border w-96 hover:shadow-none relative flex flex-col mx-auto shadow-lg m-5">
                  <div class="profile w-full flex m-3 ml-4 text-black dark">
                    <div
                        class="h-24 w-24 bg-green-200 rounded-full flex flex-shrink-0 justify-center items-center text-green-600 text-2xl font-mono">
                        U</div>
                    <div class="title mt-11 ml-3 font-bold flex flex-col">
                      <div class="name break-words">{{ trans_choice('tags.user', 2) }}</div>
                    </div>
                  </div>
                  <div class="buttons flex absolute bottom-0 font-bold right-0 text-xs text-gray-500 space-x-0 my-3.5 mr-3">
                    <div class="add border rounded-l-2xl rounded-r-sm border-gray-300 p-1 px-4 cursor-pointer hover:bg-gray-700 hover:text-white">
                        <a href="{{ route('users.index') }}" class="text-black px-4 py-3 rounded-md focus:outline-none">
                            {{ __('tags.access') }}
                        </a>
                    </div>
                  </div>
                </div>
                <!-- card end -->
                <div class="card border w-96 hover:shadow-none relative flex flex-col mx-auto shadow-lg m-5">
                  <div class="profile w-full flex m-3 ml-4 text-black">
                    <div
                        class="h-24 w-24 bg-green-200 rounded-full flex flex-shrink-0 justify-center items-center text-green-600 text-2xl font-mono">
                        R</div>
                    <div class="title mt-11 ml-3 font-bold flex flex-col">
                        <div class="name break-words">{{ trans_choice('tags.role', 2) }}</div>
                    </div>
                  </div>
                  <div class="buttons flex absolute bottom-0 font-bold right-0 text-xs text-gray-500 space-x-0 my-3.5 mr-3">
                    <div class="add border rounded-l-2xl rounded-r-sm border-gray-300 p-1 px-4 cursor-pointer hover:bg-gray-700 hover:text-white">
                        <a href="{{ route('roles.index') }}" class="text-black px-4 py-3 rounded-md focus:outline-none">
                            {{ __('tags.access') }}
                        </a>
                    </div>
                  </div>
                </div>
                <!-- card end -->
                <div class="card border w-96 hover:shadow-none relative flex flex-col mx-auto shadow-lg m-5">
                  <div class="profile w-full flex m-3 ml-4 text-black">
                    <div
                        class="h-24 w-24 bg-green-200 rounded-full flex flex-shrink-0 justify-center items-center text-green-600 text-2xl font-mono">
                        A</div>
                    <div class="title mt-11 ml-3 font-bold flex flex-col">
                        <div class="name break-words">{{ trans_choice('tags.agent', 2) }}</div>
                    </div>
                  </div>
                  <div class="buttons flex absolute bottom-0 font-bold right-0 text-xs text-gray-500 space-x-0 my-3.5 mr-3">
                    <div class="add border rounded-l-2xl rounded-r-sm border-gray-300 p-1 px-4 cursor-pointer hover:bg-gray-700 hover:text-white">
                        <a href="{{ route('agents.index') }}" class="text-black px-4 py-3 rounded-md focus:outline-none">
                            {{ __('tags.access') }}
                        </a>
                    </div>
                  </div>
                </div>
                <!-- card end -->
              </div>
        </div>
    </div>
</x-app-layout>
