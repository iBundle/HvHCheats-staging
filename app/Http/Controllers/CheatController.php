<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Cheat;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CheatController extends Controller
{
    /**
     * Display the specified cheat.
     */
    public function show(Cheat $cheat): View
    {
        // Load necessary relationships
        $cheat->load(['game', 'creator']);

        // Get related cheats (same game, excluding current cheat)
        $relatedCheats = Cheat::with(['game', 'creator'])
            ->where('game_id', $cheat->game_id)
            ->where('id', '!=', $cheat->id)
            ->latest()
            ->take(4)
            ->get();

        return view('cheat', [
            'cheat' => $cheat,
            'relatedCheats' => $relatedCheats,
        ]);
    }
}