<x-slot name="header">
    <div class="flex flex-row w-full items-center">
    <h2 class="flex-grow font-semibold text-xl text-gray-800 leading-tight">
        {{ trans_choice('tags.report', 1) }} {{ trans_choice('tags.transaction', 2) }}
    </h2>
    <a href="{{ route('reports.index') }}" class="text-sm text-gray-700 underline">{{ __('tags.return') }}</a>
    </div>
</x-slot>
<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="flex justify-end">
                <button
                wire:click="exportXLS"
                class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md">
                <x-heroicon-o-document-download class="w-10 h-10 text-center items-center"/>
                <p>{{ __('tags.download') }}</p>
            </button>
            </div>
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ trans_choice('tags.expense', 1) }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('tags.value') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
						@foreach($expenses as $expense)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                {{ $expense->expense }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                ${{ number_format($expense->value) }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xl font-medium text-black uppercase tracking-wider">
                                ${{ number_format($expenses->sum('value')) }}
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
