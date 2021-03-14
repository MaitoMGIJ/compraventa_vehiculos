<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('tags.create') }} {{ trans_choice('tags.transaction', 1) }}
        </h2>
    </x-slot>
    <form action="{{ route('transaction.store') }}" enctype="multipart/form-data" method="post">
        {{ $license }}
    </form>
</x-app-layout>
