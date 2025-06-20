<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Class PartnersController
 *
 * Handles partners page and partnership applications.
 * Following thin controller principle - delegates business logic to Action classes.
 */
final class PartnersController extends Controller
{
    /**
     * Display the partners page.
     */
    public function index(): View
    {
        return view('partners', [
            'pageTitle' => 'Партнёрская программа - HvHCheats',
            'metaDescription' => 'Присоединяйтесь к партнёрской программе HvHCheats. Высокие комиссии, эксклюзивные предложения для стримеров, блогеров и игровых сообществ.',
            'metaKeywords' => 'партнёрская программа, реферальная программа, заработок, комиссии, стримеры, блогеры'
        ]);
    }

    /**
     * Handle partnership application submission.
     */
    public function apply(Request $request): RedirectResponse
    {
        // Validation
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'telegram' => ['required', 'string', 'max:255'],
            'partnership_type' => ['required', 'string', 'in:content_creator,community,reseller,regular'],
            'platform' => ['required', 'string', 'in:youtube,twitch,telegram,discord,tiktok,vk,website,other'],
            'audience_size' => ['nullable', 'string', 'max:255'],
            'experience' => ['nullable', 'string', 'in:beginner,intermediate,experienced,expert'],
            'portfolio_links' => ['nullable', 'string', 'max:2000'],
            'motivation' => ['required', 'string', 'max:2000'],
        ], [
            'first_name.required' => 'Поле "Имя" обязательно для заполнения.',
            'last_name.required' => 'Поле "Фамилия" обязательно для заполнения.',
            'email.required' => 'Поле "Email" обязательно для заполнения.',
            'email.email' => 'Введите корректный email адрес.',
            'telegram.required' => 'Поле "Telegram" обязательно для заполнения.',
            'partnership_type.required' => 'Выберите тип партнёрства.',
            'partnership_type.in' => 'Выбранный тип партнёрства недействителен.',
            'platform.required' => 'Выберите основную платформу.',
            'platform.in' => 'Выбранная платформа недействительна.',
            'experience.in' => 'Выбранный опыт работы недействителен.',
            'motivation.required' => 'Поле "Мотивация" обязательно для заполнения.',
            'motivation.max' => 'Мотивация не должна превышать 2000 символов.',
            'portfolio_links.max' => 'Ссылки на работы не должны превышать 2000 символов.',
        ]);

        try {
            // TODO: Move to Action class
            // Example: app(ProcessPartnershipApplicationAction::class)->execute($validated);

            // For now, just log the application (in real app this would create application record and send notifications)
            \Log::info('Partnership application submitted', $validated);

            return redirect()
                ->route('partners')
                ->with('success', 'Ваша заявка на партнёрство отправлена! Наш менеджер свяжется с вами в течение 24 часов.');

        } catch (\Exception $e) {
            \Log::error('Partnership application error: ' . $e->getMessage());

            return redirect()
                ->route('partners')
                ->with('error', 'Произошла ошибка при отправке заявки. Попробуйте позже.')
                ->withInput();
        }
    }
}