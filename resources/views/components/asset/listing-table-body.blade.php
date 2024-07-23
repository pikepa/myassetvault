<tbody class="divide-y divide-gray-200 bg-white text-gray-700">
    @foreach($assets as $asset)
    <tr wire:key="$asset->id">
        <td class="whitespace-nowrap p-3 text-sm">
            <div class="flex gap-1">{{ $asset->name}}</div>
        </td>
    <td class="whitespace-nowrap  ">
        <div
            class='rounded-full -ml-1 py-0.5 pl-4 pr-4 inline-flex font-medium  text-sm     opacity-75'>
            <div>{{ $asset->location }} </div>
        </div>
    </td>
    <td class="whitespace-nowrap  ">
        <div
            class='rounded-full -ml-1 py-0.5 pl-4 pr-4 inline-flex font-medium  text-sm     opacity-75'>
            <div>{{ $asset->acquired_date_for_humans }} </div>
        </div>
    </td>

        <td class="whitespace-nowrap p-3 text-sm">
            <div class="flex flex-row-reverse gap-1">{{ $asset->acquiredValueForHumans() }}</div>
        </td>
        <td class="whitespace-nowrap p-3 text-sm">
            <div class="flex flex-row-reverse gap-1">{{ $asset->currentValueForHumans() }}</div>
        </td>
        <td class="whitespace-nowrap p-3 text-sm">
            <div
            class='rounded-full py-0.5 pl-4 pr-4 inline-flex font-medium text-sm  text-{{ $asset->status->color() }}-800  bg-{{ $asset->status->color() }}-100 opacity-75'>
            <div class="flex gap-1">{{ $asset->status->label()}}</div>
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
                    @can('update',$asset)
                        <button wire:click="edit({{ $asset->id }})"
                            class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-50 disabled:text-gray-500">
                            Edit Asset
                        </button>
                    @endcan

                @can('delete',$asset)
                    <button wire:click='delete({{ $asset->id }})'
                        wire:confirm="Are you sure you want to delete this asset?"
                        class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-50 disabled:text-gray-500">
                        <span class="text-red-600">Delete Asset</span>
                    </button>
                @endcan
                </div>
                </x-menu.ellipsis_dropdown>
            
            </div>
        </td>
    </tr>
    @endforeach
</tbody>