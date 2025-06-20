<x-layouts.app :title="__('Читы')">

    <x-navigation-heading title="Добавить коллекцию" subtitle="Управление списка коллекций"></x-navigation-heading>

    <div class="p-10">
        <ol class="flex items-center w-full text-sm font-medium text-center text-gray-500 dark:text-gray-400 sm:text-base">
            <li class="flex md:w-full items-center text-violet-600 dark:text-violet-600 sm:after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
        <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
            </svg>
            Название <span class="hidden sm:inline-flex sm:ms-2">коллекции</span>
        </span>
            </li>
            <li class="flex md:w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
        <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
            <span class="me-2">2</span>
            Подробности <span class="hidden sm:inline-flex sm:ms-2"></span>
        </span>
            </li>
            <li class="flex items-center">
                <span class="me-2">3</span>
                Подтверждение
            </li>
        </ol>

    </div>

    <div class="flex items-center justify-center">
        <div class="card w-96">
            <div class="card-body text-center">
                <flux:field>
                    <p >Название коллекции</p>
                    <flux:input wire:model="email" type="email" />
                    <flux:error name="email" />
                </flux:field>

                <flux:field class="mt-5">
                    <p class="text-center">SLUG коллекции</p>
                    <flux:input wire:model="email" type="email" />
                    <flux:error name="email" />
                </flux:field>

                <flux:button class="mt-5">Продолжить</flux:button>
            </div>
        </div>
    </div>

    <div class="flex items-center justify-center">
        <div class="card w-96">
            <div class="card-body text-center">
                <p class="text-center">Описание коллекции</p>
                <flux:textarea
                        placeholder="No lettuce, tomato, or onion..."
                />

                <p class="text-center">Изображение коллекции (1:1)</p>
                <flux:input type="file" />

                <flux:button class="mt-5">Продолжить</flux:button>
            </div>
        </div>
    </div>


</x-layouts.app>
