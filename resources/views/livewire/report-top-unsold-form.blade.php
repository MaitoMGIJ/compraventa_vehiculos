<form action="{{ route('reports.topUnsold') }}" enctype="multipart/form-data" method="post">
    <div class="pb-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-200 text-gray-700 text-lg px-6 py-4">
                <h2 class="text-2xl font-bold mb-2">{{ __('tags.top') }} {{ __('tags.unsold') }}
                    <span class="text-sm text-teal-800 font-mono bg-teal-100 inline rounded-full px-2 align-top float-right animate-pulse"></span>
                </h2>
            </div>
            <x-message-card/>
            <x-error-list/>
            <div class="shadow bg-gray-400 md:rounded-md h-full">
                <div class="p-4">
                    {{ csrf_field() }}
                    <div class="flex justify-end pt-10">
                        <x-button-search/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
