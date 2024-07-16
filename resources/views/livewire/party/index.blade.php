<x-listings.header name="Party">
        <!-- search And Add Button -->
        <x-home.search />

        <div class="relative">
            <table class="min-w-full table-fixed divide-y divide-gray-300 text-gray-800">
                <thead>
                    <tr class="space-x-4">
                        <th class="p-3 text-left text-sm font-semibold text-gray-900">
                            <x-sorting.sortable column="firstname" :$sortCol :$sortAsc>
                                <div>Name in Full</div>
                            </x-sorting.sortable>
                        </th>                        
                        <th class="p-3 text-left text-sm font-semibold text-gray-900">
                            <x-sorting.sortable column="trans_member" :$sortCol :$sortAsc>
                                <div>Membership</div>
                            </x-sorting.sortable>
                        </th>
                        <th class="p-3 text-left text-sm font-semibold text-gray-900">
                            <div>Email</div>
                        </th>
                        <th class="p-3 text-left text-sm font-semibold text-gray-900">
                            <div>Mobile</div>
                        </th>

                        <th class="p-3 text-left text-sm font-semibold text-gray-900">
                            <x-sorting.sortable column="location" :$sortCol :$sortAsc>
                                <div>Location</div>
                            </x-sorting.sortable>
                        </th>


                        <th class="p-3 text-left text-sm font-semibold text-gray-900">
                            <x-sorting.sortable column="trans_year" :$sortCol :$sortAsc>
                                <div>Sub Year</div>
                            </x-sorting.sortable>
                        </th>

                        <th class="p-3 text-left text-sm font-semibold text-gray-900">
                            <x-sorting.sortable column="trans_status" :$sortCol :$sortAsc>
                                <div>Paid Status</div>
                            </x-sorting.sortable>
                        </th>
                        <th class="p-3 text-left text-sm font-semibold text-gray-900">
                            <div>Last Payment</div>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white text-gray-700">
                    @foreach($parties as $party)
                    <tr wire:key="$party->id">
                        <td class="whitespace-nowrap p-3 text-sm">
                            <div class="flex gap-1">{{ $party->fullname }}</div>
                        </td>
                      
                        <td class="whitespace-nowrap  ">
                            @if($party->trans_member)

                            <div
                                class='rounded-full -ml-1 py-0.5 pl-4 pr-4 inline-flex font-medium text-{{ $party->trans_member->color() }}-600  bg-{{ $party->trans_member->color() }}-100   opacity-75'>
                                <div>{{ $party->trans_member->name }} </div>
                            </div>
                            @endif
                        </td>
                        <td class="whitespace-nowrap p-3 text-sm">
                            <div class="flex gap-1">{{ $party->email }}</div>
                        </td>
                        <td class="whitespace-nowrap p-3 text-sm">
                            <div class="flex gap-1">{{ $party->mobile }}</div>
                        </td>
                        <td class="whitespace-nowrap p-3 text-sm">
                            <div class="flex gap-1">{{ $party->location->label() }}</div>
                        </td>
  


                        <td class="whitespace-nowrap p-3 ">
                            @if($party->trans_year)

                                <div
                                class='rounded-full py-0.5 pl-4 pr-4 inline-flex font-medium text-sm  text-{{ $party->trans_year->color() }}-600  bg-{{ $party->trans_year->color() }}-100  opacity-75'>
                                <div class="flex gap-1">{{ $party->trans_year }} </div>
                                </div>
                            @endif
                        </td>

                        <td class="whitespace-nowrap p-3 ">
                            @if($party->trans_status)
                                <div
                                class='rounded-full py-0.5 pl-4 pr-4 inline-flex font-medium text-sm text-{{ $party->trans_status->color() }}-600  bg-{{ $party->trans_status->color() }}-100  opacity-75'>
                                <div class="flex gap-1">{{ $party->trans_status->name }} </div>
                                </div>
                            @endif
                        </td>
                            <td class="whitespace-nowrap p-3 text-sm">
                                @if(count($party->transactions) <> 0 )
                                <div class="flex gap-1">{{ $party->latest_transaction->date_for_humans }}</div>
                                @endif
                            </td>
                        <!-- Button Dropdown -->
                        <td class="whitespace-nowrap p-3 text-sm">
                            <!-- Drop down Elipsis menu alpine ui-->
                            <div class="flex justify-center">
                                <x-menu.ellipsis_dropdown>
                                    <div x-ref="panel" x-show="open" x-transition.origin.top.left x-on:click.outside="close($refs.button)"
                                        :id="$id('dropdown-button')" style="display: none;"
                                        class="z-10 absolute border-2 -top-5 right-0 mt-2 w-40 rounded-md bg-white shadow-md">
                                    @can('update', $party)
                                        <button wire:click="edit({{ $party->id }})"
                                            class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-50 disabled:text-gray-500">
                                            Edit Party
                                        </button>
                                    @endcan
                                @can('delete',$party)
                                    <button wire:click='delete({{ $party->id }})' wire:confirm="Are you sure you want to delete this party?"
                                        class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-50 disabled:text-gray-500">
                                        <span class="text-red-600">Delete Party</span>
                                    </button>
                                @endCan
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
                Results : {{ $parties->total() }}
            </div>
            {{ $parties->links('livewire.pagination') }}
        </div>
</x-listings.header>