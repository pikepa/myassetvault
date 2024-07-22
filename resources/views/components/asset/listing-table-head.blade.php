<thead>
    <tr class=" space-x-4">
        <th class="p-3 text-left text-sm font-semibold text-gray-900">
            <x-sorting.sortable column="name" :$sortCol :$sortAsc>
                <div>Name in Full</div>
            </x-sorting.sortable>
        </th>                        
        <th class="p-3 text-left text-sm font-semibold text-gray-900">
            <x-sorting.sortable column="location" :$sortCol :$sortAsc>
                <div>Location</div>
            </x-sorting.sortable>
        </th>
        <th class="p-3 text-right text-sm font-semibold text-gray-900">
                <div>Acquired Value</div>
        </th>
        <th class="p-3 text-right text-sm font-semibold text-gray-900">
                <div>Current Value</div>
        </th>
        <th class="p-6 text-center text-sm font-semibold text-gray-900">
            <x-sorting.sortable column="status" :$sortCol :$sortAsc>
                <div>Status</div>
            </x-sorting.sortable>
        </th>
        <th class="p-3 text-center text-sm font-semibold text-gray-900">

        </th>

    </tr>
</thead>