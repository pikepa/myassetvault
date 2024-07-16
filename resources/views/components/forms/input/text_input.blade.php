@props(["label","name"])
<div class="flex flex-col flex-1 gap-2">
    <h3 class="font-medium text-slate-700 text-base">{{ $label }}</h3>
    <input type="text" name='{{ $name }}' class="px-3 py-2 border border-slate-300 rounded-lg" {{ $attributes }}
       >
        @error($name)
        <p class="text-sm text-red-500" aria-live="assertive">{{ $message }}</p>
        @enderror
</div>