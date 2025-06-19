<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Game;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class GameFactory extends Factory
{
    protected $model = Game::class;

    private static array $games = [
        ['name' => 'Counter-Strike 2', 'slug' => 'cs2'],
        ['name' => 'Counter-Strike: Global Offensive', 'slug' => 'csgo'],
        ['name' => 'Valorant', 'slug' => 'valorant'],
        ['name' => 'Warface', 'slug' => 'warface'],
        ['name' => 'Roblox', 'slug' => 'roblox'],
        ['name' => 'Apex Legends', 'slug' => 'apex-legends'],
        ['name' => 'Call of Duty: Warzone', 'slug' => 'cod-warzone'],
        ['name' => 'Fortnite', 'slug' => 'fortnite'],
    ];

    public function definition(): array
    {
        static $index = 0;

        if ($index < count(self::$games)) {
            $game = self::$games[$index];
            $index++;

            return [
                'name' => $game['name'],
                'slug' => $game['slug'],
                'description' => $this->faker->paragraph(3),
                'image' => 'https://placehold.co/200x200/orange/'.$this->faker->colorName(), // будем использовать placeholder
                'version' => $this->faker->randomElement(['2.1.5', '1.39.4', '7.2.1', '2.8.0']),
                'is_active' => $this->faker->boolean(90),
                'release_date' => $this->faker->dateTimeBetween('-5 years', '-1 year'),
                'sort_order' => $index,
            ];
        }

        // Если закончились предустановленные игры, генерируем случайные
        $name = $this->faker->words(2, true);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->paragraph(3),
            'image' => 'https://placehold.co/200x200/orange/'.$this->faker->colorName(), // будем использовать placeholder
            'version' => $this->faker->randomElement(['1.0.0', '2.1.0', '3.5.2']),
            'is_active' => $this->faker->boolean(80),
            'release_date' => $this->faker->dateTimeBetween('-3 years', 'now'),
            'sort_order' => 999,
        ];
    }

    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => true,
        ]);
    }

    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
}