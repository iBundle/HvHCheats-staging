<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<section class="w-full">
    <x-navigation-heading title="Настройки" subtitle="Управляйте своим профилем и настройками учетной записи"></x-navigation-heading>

    <x-settings.layout :heading="__('Внешний вид')" :subheading="__('Обновите настройки внешнего вида вашей учетной записи')">
        <flux:radio.group x-data variant="segmented" x-model="$flux.appearance">
            <flux:radio value="light" icon="sun">{{ __('Светлая') }}</flux:radio>
            <flux:radio value="dark" icon="moon">{{ __('Темная') }}</flux:radio>
            <flux:radio value="system" icon="computer-desktop">{{ __('Системная') }}</flux:radio>
        </flux:radio.group>
    </x-settings.layout>
</section>
