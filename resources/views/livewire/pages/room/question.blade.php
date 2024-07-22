<form wire:submit.prevent="save"
      class="bg-white h-40 dark:bg-gray-800 border rounded-md border-gray-100 dark:border-gray-700 px-4 flex items-center gap-2">
    <div class="w-full">
    <x-text-input wire:model="content" id="content" placeholder="{{ __('Ask a question...') }}" class="w-full" type="text" name="content" required autofocus/>
    </div>
    <x-primary-button type="submit">OK</x-primary-button>
</form>
