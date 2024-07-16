<div class="flex justify-center bg-blue-100 pb-4 ">
    <x-forms.card>
        <div class="flex flex-col">
            <div class="flex justify-center border-b p-2 font-semibold text-lg">
                <h1>{{ $pageTitle }}</h1>
            </div>
            <form wire:submit="save" class="min-w-[30rem] flex flex-col gap-4 bg-white rounded-lg shadow p-4">
                    <x-forms.input.text_input_required wire:model.live="form.name" name="form.name" label="Name" placeholder="Enter the user's name" />
                    <x-forms.input.text_input_required wire:model="form.email" name="form.email" label="Email" placeholder="Email" />
                    <label class=" w-60 flex flex-col gap-2">
                        <h3 class="font-medium text-slate-700 text-base">Role <span class="text-red-500 opacity-75" aria-hidden="true"> *</span></h3>
                        <select
                            wire:model.blur="form.role"
                            @class([
                                'px-3 py-2 rounded-lg',
                                'border border-slate-300' => $errors->missing('form.Role'),
                                'border-2 border-red-500' => $errors->has('form.role'),
                            ])
                            @error('form.role')
                                aria-invalid="true"
                                aria-description="{{ $message }}"
                            @enderror
                        >
                            <option value="" selected >Select Role</option>
            
                            @foreach (App\Enums\Users\Role::cases() as $role)
                                <option value="{{ $role->value }}">{{ $role->label() }}</option>
                            @endforeach
                        </select>
                        @error('form.role')
                        <p class="text-sm text-red-500" aria-live="assertive">{{ $message }}</p>
                        @enderror
                    </label>    
                    @if( $editMode )
                        <button type='button' wire:click.prevent='toggleHidden'
                        class="w-1/2  bg-red-200 py-3 px-8 rounded-lg text-gray-700 font-medium">
                        Password change
                        </button>
                    @endif
                  @if(!$this->passwordHidden)                
                        <x-forms.input.password_input wire:model="form.password" name="form.password" label="New Password" placeholder="No entry required unless changing password" />
                        <x-forms.input.password_input wire:model="form.password_confirmation" name="form.password_confirmation" label="New Password Confirmation" placeholder="Password confirmation" />
                    @endif
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