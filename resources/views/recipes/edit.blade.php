<x-layout>

    <x-slot:heading>
        <h2 class="text-2xl">Редагувати рецепт <span class="font-semibold">{{ $recipe->recipe_name }}</span></h2>
    </x-slot:heading>


    <form action="{{ route('recipes.update', $recipe) }}" method="POST" enctype="multipart/form-data"
        class="max-w-4xl mx-auto px-8">
        @csrf
        @method('PATCH')

        <div class="mb-5">
            <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900">Категорія рецепту</label>
            <select id="category_id" name="category_id"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $recipe->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->category_name }}
                </option>
                @endforeach
            </select>
            @error('category_id')
            <div>{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-5">
            <label for="recipe_name" class="block mb-2 text-sm font-medium text-gray-900">Назва рецепту</label>
            <input type="text" id="recipe_name" name="recipe_name" value="{{ $recipe->recipe_name }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="" required />
            @error('recipe_name')
            <span class="mt-4 text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-5">
            <label for="ingredients" class="block mb-2 text-sm font-medium text-gray-900">Інгредієнти (розділяти
                комою)</label>
            <textarea id="ingredients" name="ingredients"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="молоко, яйця, борошно, сіль, вершкове масло" required>{{ $recipe->ingredients }}</textarea>
            @error('ingredients')
            <span class="mt-4 text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-5">
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Опис процесу
                приготування</label>
            <textarea id="description" name="description" rows="5"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                required>{{ $recipe->description }}</textarea>
            @error('description')
            <span class="mt-4 text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-5">
            <label for="image" class="block mb-2 text-sm font-medium text-gray-900">Фото готової страви (не
                обов'язково)</label>
            <input type="file" id="image" name="image"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
            @error('image')
            <span class="mt-4 text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <a href="{{ route('recipes.show', $recipe) }}"
            class="text-white bg-gray-500 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-3 text-center">Назад</a>
        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Оновити</button>

    </form>

    <!-- Delete Button Form -->
    <form action="{{ route('recipes.destroy', $recipe) }}" method="POST" class="max-w-4xl mx-auto px-8 mt-6">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Ви впевнені, що хочете видалити цей рецепт?');"
        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Видалити</button>
    </form>

</x-layout>
