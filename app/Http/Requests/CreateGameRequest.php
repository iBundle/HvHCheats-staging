<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Create Game Collection Request
 *
 * Валидация данных для создания новой игровой коллекции
 * с проверкой уникальности slug и типов файлов
 */
class CreateGameRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // TODO: Добавить проверку прав доступа при необходимости
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            // Step 1: Basic Information
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique('games', 'name')->ignore($this->route('game'))
            ],
            'slug' => [
                'required',
                'string',
                'min:3',
                'max:255',
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
                Rule::unique('games', 'slug')->ignore($this->route('game'))
            ],

            // Step 2: Media & Details
            'image' => [
                'required',
                'image',
                'mimes:jpeg,jpg,png,webp',
                'max:2048', // 2MB
                'dimensions:min_width=200,min_height=200'
            ],
            'description' => [
                'nullable',
                'string',
                'max:1000'
            ],

            // Step 3: SEO Meta (optional)
            'meta_title' => [
                'nullable',
                'string',
                'max:60'
            ],
            'meta_description' => [
                'nullable',
                'string',
                'max:160'
            ],
            'meta_keywords' => [
                'nullable',
                'string',
                'max:255'
            ],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            // Name validation messages
            'name.required' => 'Название коллекции обязательно для заполнения.',
            'name.min' => 'Название должно содержать минимум 3 символа.',
            'name.max' => 'Название не может превышать 255 символов.',
            'name.unique' => 'Коллекция с таким названием уже существует.',

            // Slug validation messages
            'slug.required' => 'SLUG обязателен для заполнения.',
            'slug.min' => 'SLUG должен содержать минимум 3 символа.',
            'slug.max' => 'SLUG не может превышать 255 символов.',
            'slug.regex' => 'SLUG может содержать только строчные буквы, цифры и дефисы.',
            'slug.unique' => 'SLUG уже используется. Выберите другой.',

            // Image validation messages
            'image.required' => 'Изображение коллекции обязательно.',
            'image.image' => 'Файл должен быть изображением.',
            'image.mimes' => 'Поддерживаются только форматы: JPEG, JPG, PNG, WebP.',
            'image.max' => 'Размер изображения не должен превышать 2MB.',
            'image.dimensions' => 'Минимальный размер изображения: 200x200 пикселей.',

            // Description validation messages
            'description.max' => 'Описание не может превышать 1000 символов.',

            // SEO validation messages
            'meta_title.max' => 'META Title не должен превышать 60 символов.',
            'meta_description.max' => 'META Description не должно превышать 160 символов.',
            'meta_keywords.max' => 'META Keywords не должны превышать 255 символов.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'name' => 'название коллекции',
            'slug' => 'SLUG',
            'image' => 'изображение',
            'description' => 'описание',
            'meta_title' => 'META Title',
            'meta_description' => 'META Description',
            'meta_keywords' => 'META Keywords',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Автоматически очищаем и форматируем slug
        if ($this->has('slug')) {
            $this->merge([
                'slug' => strtolower(trim($this->slug))
            ]);
        }

        // Очищаем пробелы в названии
        if ($this->has('name')) {
            $this->merge([
                'name' => trim($this->name)
            ]);
        }
    }

    /**
     * Get validated data with proper types and structure
     */
    public function getValidatedData(): array
    {
        $validated = $this->validated();

        // Устанавливаем значения по умолчанию
        $validated['is_active'] = true;
        $validated['sort_order'] = 999;

        // Переименовываем поля для соответствия схеме БД
        if (isset($validated['meta_title'])) {
            $validated['meta_title'] = $validated['meta_title'];
        }
        if (isset($validated['meta_description'])) {
            $validated['meta_description'] = $validated['meta_description'];
        }
        if (isset($validated['meta_keywords'])) {
            $validated['meta_keywords'] = $validated['meta_keywords'];
        }

        return $validated;
    }
}