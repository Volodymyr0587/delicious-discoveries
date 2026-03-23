<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRecipeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'ingredients' => ['required', 'string'],
            'description' => ['required', 'string', 'min:10'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Без назви це не рецепт, а секретна розробка шефа 🤫',
            'name.max' => 'Назва занадто довга. Ми, звісно, поважаємо "Лєпадотемахоселяхогалеокраніолейпсанодримюпотриммато..." 😄, але давай трохи коротше',

            'category_id.required' => 'Оберіть категорію, інакше страва загубиться в кулінарному всесвіті 🌌',
            'category_id.exists' => 'Такої категорії не існує. Ви щойно вигадали нову кухню? 😄',

            'ingredients.required' => 'Страву з повітря ще ніхто не готував 😅 Додайте хоча б щось',

            'description.required' => 'Як же нам приготувати цю страву без інструкції? Телепатія ще не вийшла в продакшн 🧠',
            'description.min' => 'Трохи більше деталей 🙏 Мінімум 10 символів, а не "варити і все" 😄',

            'image.image' => 'Це не схоже на зображення 📸 Хоча б фотку борща дайте, навіть якщо це рецепт варених яєць — бо борщ це не страва, це стиль життя 🍲',
            'image.mimes' => 'Тільки jpeg, png або jpg. GIF з котиками поки що не підтримуємо 😼',
            'image.max' => 'Зображення занадто велике 😬 Максимум 2MB, інакше кухня "впаде"',
        ];
    }
}
