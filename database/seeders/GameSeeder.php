<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    public function run(): void
    {
        $games = [
            [
                'name' => 'Counter-Strike 2',
                'slug' => 'cs2',
                'description' => 'Counter-Strike 2 - это новая версия легендарного шутера от Valve. Игра получила обновленную графику, улучшенную физику и новые возможности.',
                'version' => '1.39.4.8',
                'image' => 'https://placehold.co/200x200/orange/white', // будем использовать placeholder
                'is_active' => true,
                'release_date' => '2023-09-27',
                'sort_order' => 1,
            ],
            [
                'name' => 'Counter-Strike: Global Offensive',
                'slug' => 'csgo',
                'description' => 'CS:GO - это многопользовательский командный шутер от первого лица, который стал одной из самых популярных киберспортивных дисциплин.',
                'version' => '1.38.0.2',
                'image' => 'https://placehold.co/200x200/orange/white', // будем использовать placeholder
                'is_active' => true,
                'release_date' => '2012-08-21',
                'sort_order' => 2,
            ],
            [
                'name' => 'Valorant',
                'slug' => 'valorant',
                'description' => 'Valorant - это тактический шутер от Riot Games, сочетающий в себе точную стрельбу и уникальные способности агентов.',
                'version' => '8.01',
                'image' => 'https://placehold.co/200x200/orange/white', // будем использовать placeholder
                'is_active' => true,
                'release_date' => '2020-06-02',
                'sort_order' => 3,
            ],
            [
                'name' => 'Warface',
                'slug' => 'warface',
                'description' => 'Warface - это бесплатный многопользовательский онлайн-шутер от первого лица с различными режимами игры.',
                'version' => '2.4.1',
                'image' => 'https://placehold.co/200x200/orange/white', // будем использовать placeholder
                'is_active' => true,
                'release_date' => '2013-10-21',
                'sort_order' => 4,
            ],
            [
                'name' => 'Roblox',
                'slug' => 'roblox',
                'description' => 'Roblox - это платформа для создания и игры в пользовательские игры, популярная среди молодежи.',
                'version' => '0.582.0',
                'is_active' => true,
                'image' => 'https://placehold.co/200x200/orange/white', // будем использовать placeholder
                'release_date' => '2006-09-01',
                'sort_order' => 5,
            ],
            [
                'name' => 'Apex Legends',
                'slug' => 'apex-legends',
                'description' => 'Apex Legends - это бесплатная королевская битва от EA с уникальными персонажами и динамичным геймплеем.',
                'version' => '19.1.0',
                'image' => 'https://placehold.co/200x200/orange/white', // будем использовать placeholder
                'is_active' => true,
                'release_date' => '2019-02-04',
                'sort_order' => 6,
            ],
        ];

        foreach ($games as $gameData) {
            Game::updateOrCreate(
                ['slug' => $gameData['slug']],
                $gameData
            );
        }

        $this->command->info('Создано ' . count($games) . ' игр');
    }
}