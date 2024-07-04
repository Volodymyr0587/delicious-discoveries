<x-layout>

    <x-slot:heading>
        <h2 class="text-2xl">{{ $recipe->recipe_name }}</h2>
    </x-slot:heading>


    <!-- Recipe Section -->
    <section class="w-full items-center px-3">

        <article class="flex flex-col shadow my-4">
            <!-- Recipe Image -->

            <img class="max-w-full h-auto object-cover rounded-xl" src="{{$recipe->image ? asset('storage/' . $recipe->image) : asset('images/food.jpg') }}">



            <div class="bg-white flex flex-col justify-start p-6">
                <a href="{{ route('recipes.index', ['category_id' => $recipe->category->id]) }}" class="text-blue-700 text-sm font-bold uppercase pb-4">{{ $recipe->category->category_name }}</a>
                <p class="text-3xl font-bold pb-4">{{ $recipe->recipe_name }}</p>
                <p class="text-sm pb-8">
                    Від <a href="{{ route('user.recipes', $recipe->user) }}" class="font-semibold hover:text-gray-800">{{ $recipe->user->name }}</a>, Створено {{ $recipe->created_at->locale('uk')->diffForHumans() }}
                    @can('edit', $recipe)
                    <a href="{{ route('recipes.edit', $recipe) }}" class="mt-2 text-sm text-blue-500 font-semibold hover:underline">Редагувати рецепт</a>
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

        <div class="w-full flex pt-6">
            <a href="#" class="w-1/2 bg-white shadow hover:shadow-md text-left p-6">
                <p class="text-lg text-blue-800 font-bold flex items-center"><i class="fas fa-arrow-left pr-1"></i> Previous</p>
                <p class="pt-2">Lorem Ipsum Dolor Sit Amet Dolor Sit Amet</p>
            </a>
            <a href="#" class="w-1/2 bg-white shadow hover:shadow-md text-right p-6">
                <p class="text-lg text-blue-800 font-bold flex items-center justify-end">Next <i class="fas fa-arrow-right pl-1"></i></p>
                <p class="pt-2">Lorem Ipsum Dolor Sit Amet Dolor Sit Amet</p>
            </a>
        </div>

        <div class="w-full flex flex-col text-center md:text-left md:flex-row shadow bg-white mt-10 mb-10 p-6">
            <div class="w-full md:w-1/5 flex justify-center md:justify-start pb-4">
                <img src="https://source.unsplash.com/collection/1346951/150x150?sig=1" class="rounded-full shadow h-32 w-32">
            </div>
            <div class="flex-1 flex flex-col justify-center md:justify-start">
                <p class="font-semibold text-2xl">David</p>
                <p class="pt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel neque non libero suscipit suscipit eu eu urna.</p>
                <div class="flex items-center justify-center md:justify-start text-2xl no-underline text-blue-800 pt-4">
                    <a class="" href="#">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a class="pl-4" href="#">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="pl-4" href="#">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="pl-4" href="#">
                        <i class="fab fa-linkedin"></i>
                    </a>
                </div>
            </div>
        </div>

    </section>

</x-layout>
