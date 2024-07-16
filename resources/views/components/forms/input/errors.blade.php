@props(['name'])
<div>
    @error($name)
        <p class="text-sm text-red-500" aria-live="assertive">{{ $message }}</p>
    @enderror
</div>