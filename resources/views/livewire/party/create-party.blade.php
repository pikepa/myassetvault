<div class="flex justify-center bg-blue-100 pb-4 ">
    <x-forms.card>
        <div class="flex flex-col">
            <div class="flex justify-center border-b p-2 font-semibold text-lg">
                <h1>{{ $pageTitle }}</h1>
            </div>
            <form wire:submit="save" class="min-w-[30rem] flex flex-col gap-4 bg-white rounded-lg shadow p-4">
                <div class="flex flex-row justify-between gap-4">
                    <x-forms.input.text_input wire:model="form.firstname" name="form.firstname" label="First Name" placeholder="Enter the firstname" />
                    <x-forms.input.text_input_required wire:model="form.surname" name="form.surname" label="Last Name / Organisation Name" placeholder="Family Name" />
                </div>

                <div class="flex justify-between flex-row  items-center ">

                    <label class="flex flex-col gap-2">
                        <h3 class="font-medium text-slate-700 text-base">Title </h3>
            
                        <select
                            wire:model.blur="form.title"
                            @class([
                                'px-3 py-2 rounded-lg',
                                'border border-slate-300' => $errors->missing('form.title'),
                                'border-2 border-red-500' => $errors->has('form.title'),
                            ])
                            @error('form.title')
                                aria-invalid="true"
                                aria-description="{{ $message }}"
                            @enderror
                        >
                            <option value="" selected >Select the Title</option>
            
                            @foreach (App\Enums\Members\Title::cases() as $title)
                                <option value="{{ $title->value }}">{{ $title->label() }}</option>
                            @endforeach
                        </select>
                        @error('form.title')
                        <p class="text-sm text-red-500" aria-live="assertive">{{ $message }}</p>
                        @enderror
                    </label>

                    <fieldset class="-mt-2 ml-4 flex flex-col gap-2">
                        <div>
                            <legend class=" font-medium text-slate-700 text-base">Gender</legend>
                        </div>
            
                        <div class=" flex gap-6">
                            <label class="flex items-center gap-2">
                                <input wire:model.boolean="form.gender" type="radio" name="gender" value="true">
                                Male
                            </label>
            
                            <label class="flex items-center gap-2">
                                <input wire:model.boolean="form.gender" type="radio" name="gender" value="false">
                                Female
                            </label>
                        </div>
                        @error('form.gender')
                        <p class="text-sm text-red-500" aria-live="assertive">{{ $message }}</p>
                        @enderror
                    </fieldset>
                    <label class="mr-4 mt-4 flex items-center gap-2">
                        <input type="checkbox" wire:model.boolean="form.party_type" class="rounded" value="form.party_type" >
                        Is Organisation
                        @error('form.party_type')
                        <p class="text-sm text-red-500" aria-live="assertive">{{ $message }}</p>
                        @enderror 
                    </label>
                </div>

                <div class="flex flex-col gap-2">
                    <x-forms.input.text_input wire:model="form.profession" name="form.profession" label="Profession" placeholder="..." />

                </div>
                <div class="flex flex-row justify-between">

                    <label class=" w-60 flex flex-col gap-2">
                        <h3 class="font-medium text-slate-700 text-base">Location <span class="text-red-500 opacity-75" aria-hidden="true"> *</span></h3>
                        <select
                            wire:model.blur="form.location"
                            @class([
                                'px-3 py-2 rounded-lg',
                                'border border-slate-300' => $errors->missing('form.location'),
                                'border-2 border-red-500' => $errors->has('form.location'),
                            ])
                            @error('form.location')
                                aria-invalid="true"
                                aria-description="{{ $message }}"
                            @enderror
                        >
                            <option value="" selected >Select Location</option>
            
                            @foreach (App\Enums\Members\Location::cases() as $location)
                                <option value="{{ $location->value }}">{{ $location->label() }}</option>
                            @endforeach
                        </select>
                        @error('form.location')
                        <p class="text-sm text-red-500" aria-live="assertive">{{ $message }}</p>
                        @enderror
                    </label>
                    <label class="w-64 flex flex-col gap-2">
                        <h3 class="font-medium text-slate-700 text-base">TSS Branch <span class="text-red-500 opacity-75" aria-hidden="true"> *</span></h3>
                        <select
                            wire:model="form.branch"
                            @class([
                                'px-3 py-2 rounded-lg',
                                'border border-slate-300' => $errors->missing('form.branch'),
                                'border-2 border-red-500' => $errors->has('form.branch'),
                            ])
                            @error('form.branch')
                                aria-invalid="true"
                                aria-description="{{ $message }}"
                            @enderror
                        >            
                                <option Active value="">Choose the Branch</option>
                                <option  value="kota_kinabalu">Kota Kinabalu</option>
                                <option value="sandakan">Sandakan</option>
                            
                        </select>
                        @error('form.branch')
                        <p class="text-sm text-red-500" aria-live="assertive">{{ $message }}</p>
                        @enderror
                    </label>
                </div>
                <div class="flex flex-row justify-between">
                    <div class="flex flex-col gap-2">
                        <h3 class="w-60 font-medium text-slate-700 text-base">Mobile<span class="text-red-500 opacity-75" aria-hidden="true"> *</span> </h3>
                        <input wire:model="form.mobile" class="px-3 py-2 border border-slate-300 rounded-lg"
                            placeholder="(Incl Country Code)">
                            @error('form.mobile')
                            <p class="text-sm text-red-500" aria-live="assertive">{{ $message }}</p>
                            @enderror
                    </div>
                    <div class="flex flex-col gap-2">
                        <h3 class="w-64 font-medium text-slate-700 text-base">Email Address<span class="text-red-500 opacity-75" aria-hidden="true"> *</span></h3>
                        <input wire:model="form.email" class="px-3 py-2 border border-slate-300 rounded-lg"
                            placeholder="">
                            @error('form.email')
                            <p class="text-sm text-red-500" aria-live="assertive">{{ $message }}</p>
                            @enderror
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <h3 class="font-medium text-slate-700 text-base">Mailing Address</h3>
                    <textarea wire:model="form.mailing_addr" rows="4" class="px-3 py-2 border border-slate-300 rounded-lg"
                        placeholder="Enter your mailing address here"></textarea>
                        @error('form.mailing_addr')
                        <p class="text-sm text-red-500" aria-live="assertive">{{ $message }}</p>
                        @enderror                
                    </div>
                    
                    <div class="flex flex-row justify-between items-center">

                        <div class="flex flex-col gap-2">
                            <h3 class="w-64 font-medium text-slate-700 text-base">Member Since</span></h3>
                            <input type='date' wire:model="form.member_since" class="px-3 py-2 border border-slate-300 rounded-lg"
                                placeholder="YYYY-MM-DD">
                                @error('form.member_since')
                                <p class="text-sm text-red-500" aria-live="assertive">{{ $message }}</p>
                                @enderror
                        </div>
                        <label class="w-64 mt-4 flex items-center gap-2">
                            Deceased
                            <input type="checkbox" wire:model.boolean="form.deceased" class="rounded" value="form.deceased" >
                            @error('form.deceased')
                            <p class="text-sm text-red-500" aria-live="assertive">{{ $message }}</p>
                            @enderror 
                        </label>
                    </div>

                <div class="flex gap-4">
                    <button type='button' wire:click.prevent='backtolist'
                        class="w-full bg-red-200 py-3 px-8 rounded-lg text-gray-700 font-medium">Back</button>
                    <button type="submit"
                        class="relative w-full bg-blue-500 py-3 px-8 rounded-lg text-white font-medium disabled:cursor-not-allowed disabled:opacity-75">Save
                        <div wire:loading.flex class=" absolute top-0 right-0 bottom-0 flex items-center pr-4">
                            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                    </button>
                </div>
            </form>
            <x-forms.success_indicator />
        </div>
    </x-forms.card>
</div>