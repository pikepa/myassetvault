<x-listings.header name="Transaction">
        <!-- search And Add Button -->
        <x-transaction.search />

        <div class="relative">
            <table class="min-w-full table-fixed divide-y divide-gray-300 text-gray-800">
                <thead>
                    <tr class="space-x-4">
                        <th class="p-3 text-left text-sm font-semibold text-gray-900">
                            <x-sorting.sortable column="transaction_date" :$sortCol :$sortAsc>
                                <div>Date</div>
                            </x-sorting.sortable>
                        </th>
                        <th class="p-3 text-left text-sm font-semibold text-gray-900">
                                <div>Asset Name</div>
                        </th>                        
                        <th class="p-3 text-left text-sm font-semibold text-gray-900">
                            <x-sorting.sortable column="document_ref" :$sortCol :$sortAsc>
                                <div>Doc Ref.</div>
                            </x-sorting.sortable>
                        </th>

                        <th class="p-3 text-left text-sm font-semibold text-gray-900">
                            <x-sorting.sortable column="year" :$sortCol :$sortAsc>
                                <div>Year</div>
                            </x-sorting.sortable>
                        </th>
                        <th class="p-3 text-left text-sm font-semibold text-gray-900">
                            <x-sorting.sortable column="month" :$sortCol :$sortAsc>
                                <div>Month</div>
                            </x-sorting.sortable>
                        </th>
                        <th class="p-3 text-left text-sm font-semibold text-gray-900">
                            <x-sorting.sortable column="month" :$sortCol :$sortAsc>
                                <div>Valuation</div>
                            </x-sorting.sortable>
                        </th>
                        <th class="p-3 text-left text-sm font-semibold text-gray-900">
                            <x-sorting.sortable column="status" :$sortCol :$sortAsc>
                                <div>Paid Status</div>
                            </x-sorting.sortable>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white text-gray-700">
                    @foreach($transactions as $transaction)
                    <tr wire:key="$transaction->id">

                        <td class="whitespace-nowrap  ">
                            <div
                                class='rounded-full -ml-1 py-0.5 pl-4 pr-4 inline-flex font-medium  text-sm     opacity-75'>
                                <div>{{ $transaction->date_for_humans }} </div>
                            </div>
                        </td>
                        <td class="whitespace-nowrap p-3 text-sm">
                            <div class="flex gap-1">{{ $transaction->asset->name }}</div>
                        </td>
                        <td class="whitespace-nowrap p-3 text-sm">
                            <div class="flex gap-1">{{ $transaction->document_ref}}</div>
                        </td>



                        <td class="whitespace-nowrap p-3 ">
                            <div
                                class='rounded-full py-0.5 pl-4 pr-4 inline-flex font-medium text-sm text-blue-600  bg-blue-100  opacity-75'>
                                <div class="flex gap-1">{{ $transaction->year }} </div>
                            </div>              
                        </td>
                        <td class="whitespace-nowrap p-3 ">
                            <div
                                class='rounded-full py-0.5 pl-4 pr-4 inline-flex font-medium text-sm text-blue-600  bg-blue-100  opacity-75'>
                                <div class="flex gap-1">{{ $transaction->month }} </div>
                            </div>              
                        </td>


                        <td class="whitespace-nowrap p-3 ">
                                <div
                                class='rounded-full py-0.5 pl-4 pr-4 inline-flex font-medium text-sm   opacity-75'>
                                <div class="flex  gap-1">{{ $transaction->current_value_for_humans }} </div>
                                </div>
                        </td>

                        <td class="whitespace-nowrap p-3 ">
                            <div
                                class='rounded-full py-0.5 pl-4 pr-4 inline-flex font-medium text-sm  text-{{ $transaction->status->color() }}-600  bg-{{ $transaction->status->color() }}-100 opacity-75'>
                                <div class="flex gap-1">{{ $transaction->status->label() }} </div>
                            </div>
                        </td>
                        <!-- Button Dropdown -->
                        <td class="whitespace-nowrap p-3 text-sm">
                            <!-- Drop down Elipsis menu alpine ui-->
                            <div class="flex justify-center">
                                <x-menu.ellipsis_dropdown>
                                    <div x-ref="panel" x-show="open" x-transition.origin.top.left
                                    x-on:click.outside="close($refs.button)" :id="$id('dropdown-button')"
                                    style="display: none;"
                                    class="z-10 absolute border-2 -top-5 right-0 mt-2 w-40 rounded-md bg-white shadow-md">
                                    @can('update',$transaction)
                                        <button wire:click="edit({{ $transaction->id }})"
                                            class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-50 disabled:text-gray-500">
                                            Edit Transaction
                                        </button>
                                    @endcan

                                @can('delete',$transaction)
                                    <button wire:click='delete({{ $transaction->id }})'
                                        wire:confirm="Are you sure you want to delete this transaction?"
                                        class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-50 disabled:text-gray-500">
                                        <span class="text-red-600">Delete Transaction</span>
                                    </button>
                                @endcan
                                </div>
                                </x-menu.ellipsis_dropdown>
                            
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div wire:loading class="absolute inset-0 bg-white opacity-50">
                <!--  -->
            </div>
            <div wire:loading.flex class="flex justify-center items-center absolute inset-0">
                <x-icon.spinner size="10" />
            </div>
        </div>
        <div class="pt-4 flex justify-between items-center">
            <div class="text-gray-700 text-sm">
                Results : {{ $transactions->total() }}
            </div>
            {{ $transactions->links('livewire.pagination') }}
        </div>
</x-listings.header>
