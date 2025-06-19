<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Cheat;
use App\Models\Game;
use App\Models\User;
use Illuminate\Database\Seeder;

class CheatSeeder extends Seeder
{
    public function run(): void
    {
        $games = Game::all();

        if ($games->isEmpty()) {
            $this->command->warn('Сначала запустите GameSeeder');
            return;
        }

        // Создаем пользователя-администратора если его нет
        $adminUser = User::first() ?? User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@hvhcheats.com',
        ]);

        $cheatsCreated = 0;

        foreach ($games as $game) {
            // Создаем от 3 до 7 читов для каждой игры
            $cheatsCount = rand(3, 7);

            for ($i = 0; $i < $cheatsCount; $i++) {
                Cheat::factory()->create([
                    'game_id' => $game->id,
                    'created_by' => $adminUser->id,
                ]);

                $cheatsCreated++;
            }
        }

        $this->command->info("Создано {$cheatsCreated} читов для {$games->count()} игр");
    }
}