<x-listings.header name="Users" >    
    <x-listings.search />
    <div class="relative">
        <table class="min-w-full table-fixed divide-y divide-gray-300 text-gray-800">
            <thead>
                <tr class="space-x-4">
                    <th class="p-3 text-left text-sm font-semibold text-gray-900">
                        <x-sorting.sortable column="firstname" :$sortCol :$sortAsc>
                            <div>User Name</div>
                        </x-sorting.sortable>
                    </th>  

                    <th class="p-3 text-left text-sm font-semibold text-gray-900">
                            <div>Email</div>
                    </th>                        
                    
                    <th class="p-3 text-left text-sm font-semibold text-gray-900">
                        <x-sorting.sortable column="created_at" :$sortCol :$sortAsc>
                            <div>Date Created</div>
                        </x-sorting.sortable>
                    </th>

                    <th class="p-3 text-left text-sm font-semibold text-gray-900">
                        <x-sorting.sortable column="role" :$sortCol :$sortAsc>
                            <div>Assigned Role</div>
                        </x-sorting.sortable>
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white text-gray-700">
                @foreach($users as $user)
                <tr wire:key="$user->id">
                    <td class="whitespace-nowrap p-3 text-sm">
                        <div class="flex gap-1">{{ $user->name }}</div>
                    </td>
                    <td class="whitespace-nowrap p-3 text-sm">
                        <div class="flex gap-1">{{ $user->email }}</div>
                    </td>
                    <td class="whitespace-nowrap p-3 text-sm">
                        <div class="flex gap-1">{{ $user->created_at->format('M d, Y') }}</div>
                    </td>
                    <td class="whitespace-nowrap p-3 text-sm">
                        <div class="flex gap-1">{{ $user->role->label() }}</div>
                    </td>


                    <!-- Button Dropdown -->
                    <td class="whitespace-nowrap p-3 text-sm">
                        <!-- Drop down Elipsis menu alpine ui-->
                        <div class="flex justify-center">
                            <x-menu.ellipsis_dropdown>
                                <div x-ref="panel" x-show="open" x-transition.origin.top.left x-on:click.outside="close($refs.button)"
                                    :id="$id('dropdown-button')" style="display: none;"
                                    class="z-10 absolute border-2 -top-5 right-0 mt-2 w-40 rounded-md bg-white shadow-md">
                                @can('update', $user)
                                    <button wire:click="edit({{ $user->id }})"
                                        class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-50 disabled:text-gray-500">
                                        Edit User
                                    </button>
                                @endcan
                                                            
                                @can('delete', $user)
                                    <button wire:click='delete({{ $user->id }})' wire:confirm="Are you sure you want to delete this party?"
                                        class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-50 disabled:text-gray-500">
                                        <span class="text-red-600">Delete User</span>
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

    <div class="pt-4 flex justify-between items-center">
        <div class="text-gray-700 text-sm">
            Results : {{ $users->total() }}
        </div>
        {{ $users->links('livewire.pagination') }}
    </div>
</x-listings.header>