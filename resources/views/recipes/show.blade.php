<x-layout>

    <x-slot:heading>
        <h2 class="text-2xl uppercase font-bold">{{ $recipe->recipe_name }}</h2>
    </x-slot:heading>


    <!-- Recipe Section -->
    <section class="w-full items-center px-3">

        <article class="flex flex-col shadow my-4">
            <!-- Recipe Image -->

            <img class="max-w-full h-auto object-cover rounded-xl"
                src="{{$recipe->image ? asset('storage/' . $recipe->image) : asset('images/food.jpg') }}">



            <div class="bg-white flex flex-col justify-start p-6">
                <a href="{{ route('recipes.index', ['category_id' => $recipe->category->id]) }}"
                    class="text-blue-700 text-sm font-bold uppercase pb-4">{{ $recipe->category->category_name }}</a>
                <p class="text-3xl font-bold pb-4 first-letter:text-7xl capitalize">{{ $recipe->recipe_name }}</p>
                <p class="text-sm pb-8">
                    Від <a href="{{ route('user.recipes', $recipe->user) }}"
                        class="font-semibold hover:text-gray-800">{{ $recipe->user->name }}</a>, Створено {{
                    $recipe->created_at->locale('uk')->diffForHumans() }}
                    @can('edit', $recipe)
                    <a href="{{ route('recipes.edit', $recipe) }}"
                        class="mt-2 text-sm text-blue-500 font-semibold hover:underline">Редагувати рецепт</a>
                    @endcan
                </p>
                <h1 class="text-2xl font-bold pb-3">Інгредієнти</h1>
                <p class="pb-3">
                <ul>
                    @foreach (explode(',', $recipe->ingredients) as $ingredient)
                    <li>{{ trim($ingredient) }}</li>
                    @endforeach
                </ul>
                </p>
                <h1 class="text-2xl font-bold py-3">Процес приготування</h1>
                <p class="pb-3">{{ $recipe->description }}</p>

            </div>
        </article>


        <div class="w-full flex flex-col text-center md:text-left shadow mt-10 mb-10 p-6">
            <!-- Add Comment Form -->

            @auth
                @if (auth()->id() !== $recipe->user->id)
                    <h2 class="text-xl font-bold my-4">Додати коментар</h2>
                    <form action="{{ route('comments.store', $recipe) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <textarea id="body" name="body" rows="4"
                                class="mt-1 p-4 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md"
                                required></textarea>
                            @error('body')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Додати</button>
                    </form>
                @else
                <div class="bg-yellow-200 p-4 mt-4">
                    <p>Ви не можете коментувати власний рецепт. Це зроблять інші користувачі <span>&#128521;</span></p>
                </div>
                @endif
            @else
            <div class="bg-yellow-200 p-4 mt-4">
                <p>Будь ласка, <a href="{{ route('login') }}" class="text-blue-500 underline">увійдіть</a>, щоб додати коментар.</p>
            </div>
            @endauth

            <!-- Comments List -->
            <h3 class="mt-8 text-xl font-semibold">Коментарі</h3>
            @foreach ($recipe->comments as $comment)
            <div class="mt-4 p-4 bg-white shadow rounded">
                <p class="font-semibold text-xl">{{ $comment->user->name }}</p>
                <p class="pt-2">{{ $comment->body }}</p>

                @can('deleteComment', $comment)
                <form action="{{ route('comment.destroy', $comment) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-500 font-semibold" type="sumbit" onclick="return confirm('Ви впевнені, що хочете видалити свій коментар?');">Delete</button>
                </form>
                @endcan

            </div>
            @endforeach
        </div>


        <div class="w-full flex pt-6">
            @if($previousRecipe)
            <a href="{{ route('recipes.show', $previousRecipe) }}"
                class="w-1/2 bg-white shadow hover:shadow-md text-left p-6">
                <p class="text-lg text-blue-800 font-bold flex items-center"><i class="fas fa-arrow-left pr-1"></i>
                    Previous</p>
                <p class="pt-2">{{ $previousRecipe->recipe_name }}</p>
            </a>
            @else
            <div class="w-1/2"></div>
            @endif

            @if($nextRecipe)
            <a href="{{ route('recipes.show', $nextRecipe) }}"
                class="w-1/2 bg-white shadow hover:shadow-md text-right p-6">
                <p class="text-lg text-blue-800 font-bold flex items-center justify-end">Next <i
                        class="fas fa-arrow-right pl-1"></i></p>
                <p class="pt-2">{{ $nextRecipe->recipe_name }}</p>
            </a>
            @else
            <div class="w-1/2"></div>
            @endif
        </div>
    </section>

</x-layout>
