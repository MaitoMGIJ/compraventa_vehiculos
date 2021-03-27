<x-slot name="header">
    <div class="flex flex-row w-full items-center">
    <h2 class="flex-grow font-semibold text-xl text-gray-800 leading-tight">
        {{ __('tags.balance') }}
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
                                {{ __('tags.date') }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ trans_choice('tags.entry', 2) }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ trans_choice('tags.expense', 2) }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ trans_choice('tags.commission', 2) }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ trans_choice('tags.end', 2) }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ trans_choice('tags.income', 2) }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('tags.withdrawal') }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">
                                {{ __('tags.balance') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
						@foreach($transactions as $transaction)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                {{ $transaction->date }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                ${{ number_format($transaction->entries) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                ${{ number_format($transaction->expenses) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                ${{ number_format($transaction->commissions) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                ${{ number_format($transaction->ends) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                ${{ number_format($transaction->incomes) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                ${{ number_format($transaction->withdrawals) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-xl font-bold text-center text-black">
                                ${{ number_format($transaction->balance) }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-gray-50">
                        <tr>
                            <th colspan="7" scope="col"
                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('tags.cash') }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-2xl font-bold text-black uppercase tracking-wider">
                                    ${{ number_format($transactions->sum('balance')) }}
                            </th>
                        </tr>
                        <tr>
                            <th colspan="7"
                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ trans_choice('tags.vehicle', 2) }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-2xl font-bold text-black uppercase tracking-wider">
                                    ${{ number_format($unSold) }}
                            </th>
                        </tr>
                        <tr>
                            <th colspan="7"
                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('tags.total') }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-3xl font-bold text-black uppercase tracking-wider">
                                    ${{ number_format($transactions->sum('balance') + $unSold) }}
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
