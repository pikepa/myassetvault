<div x-data="{
    open: false,
    toggle() {
        if (this.open) {
            return this.close()
        }
        this.$refs.button.focus()

        this.open = true
    },
    close(focusAfter) {
        if (! this.open) return

        this.open = false

        focusAfter && focusAfter.focus()
    }
    }" x-on:keydown.escape.prevent.stop="close($refs.button)"
        x-on:focusin.window="! $refs.panel.contains($event.target) && close()" x-id="['dropdown-button']" class="relative">
        <!-- Button -->
        <button x-ref="button" x-on:click="toggle()" :aria-expanded="open" :aria-controls="$id('dropdown-button')"
            type="button" class="flex items-center gap-2 bg-white  rounded-md shadow">
            <!-- Heroicon: chevron-down -->
            <x-icon.ellipsis-horizontal />
        </button>
    <!-- Panel - Enter the buttons for the ellipsis menu here-->
    {{ $slot }}

</div>