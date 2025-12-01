<x-filament::page>
    <x-filament::section
        icon="heroicon-o-paper-airplane"
        icon-color="danger"
    >
        <x-slot name="description">
            Send an email to all alumni to be notified of updating their details for alumni tracer.
        </x-slot>

        <form wire:submit.prevent="submit" class="space-y-4" method="POST">
            <x-filament::button icon="heroicon-o-paper-airplane" type="submit" wire:loading.attr="disabled">
                <span wire:loading.remove>Send Email Notification</span>
                <span wire:loading>Sending...</span>
            </x-filament::button>
        </form>
    </x-filament::section>
</x-filament::page>