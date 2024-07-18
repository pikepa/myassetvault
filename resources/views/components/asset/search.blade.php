<div class="flex flex-row justify-between items-center">
    <div class="relative text-sm text-gray-800">
        <div class="absolute pl-2 left-0 top-0 bottom-0 flex items-center pointer-events-none text-gray-500">
            <x-icon.magnifying-glass />
        </div>
        <input wire:model.live.debounce.250ms="search" type="text" placeholder="Search Asset Name " class="block w-full rounded-lg border-0 py-1.5 pl-10 text-gray-900 ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
    </div>
    <div class='flex flex-row gap-2 button rounded-lg px-3 py-2 bg-blue-700 text-white mr-4'>
        <x-icon.plus />
        <a href="/asset/add">
            <button>
                 Add Asset
            </button>
            </a>
    </div>

</div>