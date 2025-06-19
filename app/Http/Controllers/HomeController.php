<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

/**
 * Class HomeController
 *
 * Handles the main landing page and homepage functionality.
 * Following thin controller principle - delegates business logic to services.
 */
final class HomeController extends Controller
{
    /**
     * Display the welcome page.
     *
     * Shows the main landing page with hero section, features,
     * popular collections, top cheaters, and featured cheats.
     */
    public function index(Request $request): View
    {
        // In future, these will be moved to separate Action classes
        // For now, keeping it simple as requested

        return view('welcome', [
            'pageTitle' => 'HvHCheats - лучшие в своем деле',
            'metaDescription' => 'Лучшие читы СНГ и всего мира с регулярными обновлениями. CS2, Valorant, Warface, Roblox и другие популярные игры.',
            'metaKeywords' => 'читы, cheats, cs2, valorant, warface, roblox, cs go, aimbot, wallhack, hvh'
        ]);
    }

    public function cheat(Request $request): View {
        return view('cheat');
    }
}