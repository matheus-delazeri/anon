<div class="p-6">
    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
        {{ __('Generate a :role invite', ['role' => $role == \App\Enums\UserRoleEnum::MODERATOR->value ? __('moderator') : __('participant')]) }}
    </h2>

    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
        {{ __('After clicking "Generate", an invite will be created and be valid for 1h.') }}
    </p>

    @isset($invite)
        <div class="mt-6 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Invite: :link', ['link' => $invite->link()]) }}
        </div>
    @else
        <div class="mt-6 flex justify-end">
            <x-secondary-button wire:click="generate">
                {{ __('Generate') }}
            </x-secondary-button>
        </div>
    @endisset
</div>
