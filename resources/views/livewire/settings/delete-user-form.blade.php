<?php

use App\Models\User;
use Laravel\WorkOS\Http\Requests\AuthKitAccountDeletionRequest;
use Livewire\Volt\Component;

new class extends Component {
    /**
     * Delete the currently authenticated user.
     */
    public function deleteUser(AuthKitAccountDeletionRequest $request): void
    {
        $request->delete(
            using: fn (User $user) => $user->delete()
        );

        $this->redirect('/', navigate: true);
    }
}; ?>

<section class="mt-10 space-y-6">
    <div class="relative mb-5">
        <flux:heading>{{ __('Удалить аккаунт') }}</flux:heading>
        <flux:subheading>{{ __('Удалить свою учетную запись и все ее ресурсы') }}</flux:subheading>
    </div>

    <flux:modal.trigger name="confirm-user-deletion">
        <flux:button variant="danger" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
            {{ __('Удалить аккаунт') }}
        </flux:button>
    </flux:modal.trigger>

    <flux:modal name="confirm-user-deletion" :show="$errors->isNotEmpty()" focusable class="max-w-lg">
        <form wire:submit="deleteUser" class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Вы уверены, что хотите удалить свою учетную запись?') }}</flux:heading>

                <flux:subheading>
                    {{ __('После удаления вашей учетной записи все ее ресурсы и данные также будут окончательно удалены. Подтвердите, что вы хотите окончательно удалить свою учетную запись.') }}
                </flux:subheading>
            </div>

            <div class="flex justify-end space-x-2 rtl:space-x-reverse">
                <flux:modal.close>
                    <flux:button variant="filled">{{ __('Отменить') }}</flux:button>
                </flux:modal.close>

                <flux:button variant="danger" type="submit">{{ __('Удалить аккаунт') }}</flux:button>
            </div>
        </form>
    </flux:modal>
</section>
