<form wire:submit.prevent="save" class="flex gap-2 items-center justify-center">
    <div class="w-full">
    <x-text-input wire:model="answer" id="answer" placeholder="{{ __('Type your answerer here...') }}" class="w-full" type="text" name="answer" required autofocus/>
    </div>
    <x-primary-button type="submit">OK</x-primary-button>
</form>
