<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Cheat;
use App\Models\Game;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CheatFactory extends Factory
{
    protected $model = Cheat::class;

    private static array $cheatTypes = [
        'AimBot Pro',
        'WallHack Ultimate',
        'ESP Deluxe',
        'No Recoil',
        'Speed Hack',
        'God Mode',
        'Infinite Ammo',
        'Auto Headshot',
        'Radar Hack',
        'Trigger Bot',
        'Bunny Hop',
        'Silent Aim',
        'Magic Bullet',
        'Anti-Flashbang',
        'Glow ESP',
    ];

    public function definition(): array
    {
        $cheatType = $this->faker->randomElement(self::$cheatTypes);
        $version = $this->faker->randomFloat(1, 1.0, 9.9);
        $name = $cheatType . ' v' . $version;

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'image'=> 'https://placehold.co/600x400?text='.$name,
            'description' => $this->generateDescription($cheatType),
            'game_id' => Game::inRandomOrder()->first()?->id ?? Game::factory(),
            'created_by' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'meta_title' => null,
            'meta_description' => null,
            'meta_keywords' => $this->generateKeywords($cheatType),
        ];
    }

    private function generateDescription(string $cheatType): string
    {
        $descriptions = [
            'AimBot Pro' => 'Профессиональный аимбот с настраиваемой скоростью наведения. Поддерживает все виды оружия и обходит основные античит системы.',
            'WallHack Ultimate' => 'Позволяет видеть врагов сквозь стены. Отображает здоровье, расстояние и тип оружия противников.',
            'ESP Deluxe' => 'Расширенная система отображения информации. Показывает предметы, врагов, союзников и важные объекты на карте.',
            'No Recoil' => 'Полностью убирает отдачу оружия. Настраиваемые параметры для каждого типа оружия.',
            'Speed Hack' => 'Увеличивает скорость передвижения персонажа. Безопасные значения для избежания обнаружения.',
        ];

        $baseDescription = $descriptions[$cheatType] ?? 'Мощный игровой чит для улучшения игрового опыта.';

        return $baseDescription . "\n\nОсновные возможности:\n" .
            "• Простая установка и настройка\n" .
            "• Регулярные обновления\n" .
            "• Техническая поддержка\n\n" .
            "⚠️ Внимание! Использование читов может привести к блокировке аккаунта. " .
            "Данный контент предоставляется исключительно в ознакомительных целях.";
    }

    private function generateKeywords(string $cheatType): string
    {
        $baseKeywords = ['чит', 'hack', 'читы', 'скачать'];

        $typeKeywords = match(true) {
            str_contains($cheatType, 'Aim') => ['aimbot', 'автоприцел', 'aim hack'],
            str_contains($cheatType, 'Wall') => ['wallhack', 'wh', 'видимость'],
            str_contains($cheatType, 'ESP') => ['esp', 'подсветка', 'информация'],
            str_contains($cheatType, 'Speed') => ['speed hack', 'ускорение', 'скорость'],
            str_contains($cheatType, 'Recoil') => ['no recoil', 'без отдачи', 'recoil'],
            default => ['game hack', 'mod', 'модификация']
        };

        return implode(', ', array_merge($baseKeywords, $typeKeywords));
    }

    public function forGame(int $gameId): static
    {
        return $this->state(fn (array $attributes) => [
            'game_id' => $gameId,
        ]);
    }
}