<div>
    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __("New room") }}</h2>
    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ __("Create a new room and share with the participants!") }}</p>

    <form class="mt-4" wire:submit.prevent="save">
        <div>
            <x-input-label for="name" :value="__('Name')"/>
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required
                          autofocus/>
            <x-input-error :messages="$errors->get('form.name')" class="mt-2"/>
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Description')"/>

            <x-text-input wire:model="description" id="description" class="block mt-1 w-full"
                          type="text"
                          name="description"
                          required/>

            <x-input-error :messages="$errors->get('form.description')" class="mt-2"/>
        </div>

        <x-primary-button class="mt-4" type="submit">{{ __('Save') }}</x-primary-button>
    </form>
</div>
