<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Class ContactController
 *
 * Handles contact page and support requests.
 * Following thin controller principle - delegates business logic to Action classes.
 */
final class ContactController extends Controller
{
    /**
     * Display the contact page.
     */
    public function index(): View
    {
        return view('contact', [
            'pageTitle' => 'Служба поддержки - HvHCheats',
            'metaDescription' => 'Свяжитесь с нашей службой поддержки HvHCheats. Получите помощь по установке читов, оплате, техническим вопросам.',
            'metaKeywords' => 'поддержка, служба поддержки, помощь, техподдержка, hvhcheats, контакты'
        ]);
    }

    /**
     * Handle contact form submission.
     */
    public function send(Request $request): RedirectResponse
    {
        // Validation
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'category' => ['required', 'string', 'in:technical,payment,installation,account,cheats,other'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:2000'],
        ], [
            'name.required' => 'Поле "Имя" обязательно для заполнения.',
            'email.required' => 'Поле "Email" обязательно для заполнения.',
            'email.email' => 'Введите корректный email адрес.',
            'category.required' => 'Выберите категорию вопроса.',
            'category.in' => 'Выбранная категория недействительна.',
            'subject.required' => 'Поле "Тема сообщения" обязательно для заполнения.',
            'subject.max' => 'Тема сообщения не должна превышать 255 символов.',
            'message.required' => 'Поле "Сообщение" обязательно для заполнения.',
            'message.max' => 'Сообщение не должно превышать 2000 символов.',
        ]);

        try {
            // TODO: Move to Action class
            // Example: app(SendContactMessageAction::class)->execute($validated);

            // For now, just log the message (in real app this would send email/create ticket)
            \Log::info('Contact form submission', $validated);

            return redirect()
                ->route('contact')
                ->with('success', 'Ваше сообщение отправлено! Мы свяжемся с вами в ближайшее время.');

        } catch (\Exception $e) {
            \Log::error('Contact form error: ' . $e->getMessage());

            return redirect()
                ->route('contact')
                ->with('error', 'Произошла ошибка при отправке сообщения. Попробуйте позже.')
                ->withInput();
        }
    }
}