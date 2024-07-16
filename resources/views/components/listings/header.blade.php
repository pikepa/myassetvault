@props(['name'])
<div class="ml-10">
    <div class="flex flex-col gap-6">
        <div class="flex flex-row justify-between">
            <h2 class="text-xl p-3">{{ $name }} Listing</h2>
            <h2 class="text-gray-500 p-3 mr-4">Logged in as: {{ auth()->user()->name }}</h2>
        </div>
        {{ $slot }}
    </div>
</div>