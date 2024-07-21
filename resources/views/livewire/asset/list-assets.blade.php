<x-listings.header name="Owner Asset & Liability">
    <!-- search And Add Button -->
      <x-asset.search />
      <div class="text-xl font-semibold">Asset Type : {{ request()->segment(3) }}</div>
    <div class="relative">
        <table class="min-w-full table-fixed divide-y divide-gray-300 text-gray-800">
                <!-- foreach Asset Type -->
                <x-asset.listing-table-head :$sortCol :$sortAsc :$asset_type/>  

                <x-asset.listing-table-body :$assets />
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
            Results : {{ $assets->total() }}
        </div>
        {{ $assets->links('livewire.pagination') }}
    </div>
</x-listings.header>
