<div class=" flex justify-center bg-blue-100 pb-4 ">
    <x-forms.card>
        <div class="flex flex-col">
            <div class="flex justify-center border-b p-2 font-semibold text-lg">
                <h1>{{ $pageTitle }}</h1>
            </div>
            <form wire:submit="save" class="min-w-[30rem] flex flex-col gap-4 bg-white rounded-lg shadow p-4">
                <div class="flex flex-row justify-between gap-4">
                    <label class="w-36 flex flex-col gap-2">
                        <h3 class="font-medium text-slate-700 text-base">Asset Type<span class="text-red-500 opacity-75" aria-hidden="true"> *</span></h3>
            
                        <select
                        wire:model.blur="form.asset_type"
                        @class([
                            'px-3 py-2 rounded-lg',
                            'border border-slate-300' => $errors->missing('form.status'),
                            'border-2 border-red-500' => $errors->has('form.status'),
                        ])
                        @error('form.asset_type')
                            aria-invalid="true"
                            aria-description="{{ $message }}"
                        @enderror
                    >
                        <option value="" selected>Select Type</option>
                        @foreach (App\Enums\Assets\AssetType::cases() as $type)
                            <option value="{{ $type->value}}">{{ $type->label() }}</option>
                        @endforeach
                    </select>
                        @error('form.asset_type')
                        <p class="text-sm text-red-500" aria-live="assertive">{{ $message }}</p>
                        @enderror
                    </label>
                    <div class="w-24 flex flex-col gap-2">
                        <h3 class="font-medium text-slate-700 text-base">Qty<span class="text-red-500 opacity-75" aria-hidden="true"> *</span> </h3>
                        <input wire:model="form.qty" class="px-3 py-2 border border-slate-300 rounded-lg"
                            placeholder="Qty">
                            @error('form.qty')
                            <p class="text-sm text-red-500" aria-live="assertive">{{ $message }}</p>
                            @enderror
                    </div>
                    <label class="w-52 flex flex-col gap-2">
                        <h3 class="font-medium text-slate-700 text-base">Location<span class="text-red-500 opacity-75" aria-hidden="true"> *</span></h3>
            
                        <select
                        wire:model.blur="form.location"
                        @class([
                            'px-3 py-2 rounded-lg',
                            'border border-slate-300' => $errors->missing('form.location'),
                            'border-2 border-red-500' => $errors->has('form.status'),
                        ])
                        @error('form.location')
                            aria-invalid="true"
                            aria-description="{{ $message }}"
                        @enderror
                    >
                        <option value="" selected disabled>Asset Type</option>
        
                        @foreach (App\Enums\Assets\Location::cases() as $location)
                            <option value="{{ $location->value}}">{{ $location->label() }}</option>
                        @endforeach
                    </select>
                        @error('form.location')
                        <p class="text-sm text-red-500" aria-live="assertive">{{ $message }}</p>
                        @enderror
                    </label>
                </div>
                <div class="flex flex-col flex-1 gap-2">
                    <h3 class="font-medium text-slate-700 text-base">Asset Name.<span class="text-red-500 opacity-75" aria-hidden="true"> *</span></h3>
                    <input wire:model="form.name" class="px-3 py-2 border border-slate-300 rounded-lg"
                        placeholder="Enter the Asset name.">
                        @error('form.name')
                        <p class="text-sm text-red-500" aria-live="assertive">{{ $message }}</p>
                        @enderror                        
                </div>
                <div class="flex flex-col gap-2">
                    <h3 class="font-medium text-slate-700 text-base">Description</h3>
                    <textarea wire:model="form.description" rows="4" class="px-3 py-2 border border-slate-300 rounded-lg"
                        placeholder="Enter a full description for the asset."></textarea>
                        @error('form.description')
                        <p class="text-sm text-red-500" aria-live="assertive">{{ $message }}</p>
                        @enderror                
                </div>
                <div class="flex flex-row justify-between gap-4">
                    <label class="flex flex-col gap-2">
                        <h3 class=" font-medium text-slate-700 text-base">Year Acquired <span class="text-red-500 opacity-75" aria-hidden="true"> *</span></h3>
                        <select
                        wire:model.blur="form.year"
                        @class([
                            'w-32 px-3 py-2 rounded-lg',
                            'border border-slate-300' => $errors->missing('form.year'),
                            'border-2 border-red-500' => $errors->has('form.year'),
                        ])
                        @error('form.year')
                            aria-invalid="true"
                            aria-description="{{ $message }}"
                        @enderror
                    >
                        <option value="" selected disabled>Select year </option>
        
                        @foreach (App\Enums\Common\Year::cases() as $year)
                            <option value="{{ $year->value}}">{{ $year }}</option>
                        @endforeach
                    </select>
                        @error('form.year')
                        <p class="text-sm text-red-500" aria-live="assertive">{{ $message }}</p>
                        @enderror
                    </label>

                    <label class="flex flex-col gap-2">
                        <h3 class=" font-medium text-slate-700 text-base">Month<span class="text-red-500 opacity-75" aria-hidden="true"> *</span></h3>
                        <select
                        wire:model.blur="form.month"
                        @class([
                            'w-32 px-3 py-2 rounded-lg',
                            'border border-slate-300' => $errors->missing('form.month'),
                            'border-2 border-red-500' => $errors->has('form.month'),
                        ])
                        @error('form.month')
                            aria-invalid="true"
                            aria-description="{{ $message }}"
                        @enderror
                    >
                        <option value="" selected disabled>Select month </option>
        
                        @foreach (App\Enums\Common\Month::cases() as $month)
                            <option value="{{ $month->value}}">{{ $month }}</option>
                        @endforeach
                    </select>
                        @error('form.month')
                        <p class="text-sm text-red-500" aria-live="assertive">{{ $message }}</p>
                        @enderror
                    </label>
                    <div class="w-48 flex flex-col gap-2">
                        <h3 class="font-medium text-slate-700 text-base">Acquired Value<span class="text-red-500 opacity-75" aria-hidden="true"> *</span> </h3>
                        <input wire:model="form.acquired_value" class="px-3 py-2 border border-slate-300 rounded-lg"
                            placeholder="Amount in cents">
                            @error('form.acquired_value')
                            <p class="text-sm text-red-500" aria-live="assertive">{{ $message }}</p>
                            @enderror
                    </div>
                </div>

                <div class="flex flex-row justify-start gap-4">
                    <label class="w-32 flex flex-col gap-2">
                        <h3 class="font-medium text-slate-700 text-base">Status<span class="text-red-500 opacity-75" aria-hidden="true"> *</span></h3>
            
                        <select
                        wire:model.blur="form.status"
                        @class([
                            'px-3 py-2 rounded-lg',
                            'border border-slate-300' => $errors->missing('form.status'),
                            'border-2 border-red-500' => $errors->has('form.status'),
                        ])
                        @error('form.status')
                            aria-invalid="true"
                            aria-description="{{ $message }}"
                        @enderror
                    >
                        <option value="" selected disabled>Asset Status</option>
        
                        @foreach (App\Enums\Assets\AssetStatus::cases() as $status)
                            <option value="{{ $status->value}}">{{ $status->label() }}</option>
                        @endforeach
                    </select>
                        @error('form.status')
                        <p class="text-sm text-red-500" aria-live="assertive">{{ $message }}</p>
                        @enderror
                    </label>
                </div>


                <div class="flex gap-4">
                    <button type='button' wire:click.prevent='backtolist'
                    class="w-full bg-red-200 py-3 px-8 rounded-lg text-gray-700 font-medium">Back</button>

                    <button type="submit"
                        class="w-full bg-blue-500 py-3 px-8 rounded-lg text-white font-medium">Save</button>
                </div>
            </form>
            <x-forms.success_indicator />
        </div>
    </x-forms.card>
</div>