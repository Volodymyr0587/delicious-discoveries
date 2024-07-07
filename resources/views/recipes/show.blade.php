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
                    Від <a href="{{ route('user.recipes', $recipe->user) }}" class="font-semibold hover:text-gray-800">{{ $recipe->user->name }}</a>
                    Створено {{ $recipe->created_at->locale('uk')->diffForHumans() }}.
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

                @auth
                    @if (auth()->id() !== $recipe->user_id)
                    <div x-data="{
                            liked: {{ $recipe->isLikedBy(auth()->user()) ? 'true' : 'false' }},
                            likesCount: {{ $recipe->likes()->count() }},
                            likeUrl: '{{ route('recipes.like', $recipe) }}',
                            unlikeUrl: '{{ route('recipes.unlike', $recipe) }}',
                            toggleLike() {
                                if (this.liked) {
                                    this.unlikeRecipe();
                                } else {
                                    this.likeRecipe();
                                }
                            },
                            likeRecipe() {
                                fetch(this.likeUrl, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        this.liked = true;
                                        this.likesCount = data.likes_count;
                                    } else {
                                        alert(data.error);
                                    }
                                });
                            },
                            unlikeRecipe() {
                                fetch(this.unlikeUrl, {
                                    method: 'DELETE',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        this.liked = false;
                                        this.likesCount = data.likes_count;
                                    } else {
                                        alert(data.error);
                                    }
                                });
                            }
                        }" class="mt-4 flex items-center">

                        <svg @click="toggleLike"

                            height="40px" width="40px"  version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 511.999 511.999" xml:space="preserve"
                            fill="#000000">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path class="hover:cursor-pointer" :class="liked ? 'fill-current text-red-500 hover:text-red-700' : 'fill-current text-white hover:text-red-300'"
                                    d="M404.121,52.066c-15.078-4.814-29.245-7.037-42.436-7.037c-41.763,0-73.826,22.246-94.686,54.895 c-2.851,4.466-7.544,6.708-12.265,6.708c-4.462,0-8.953-1.999-11.948-6.013c-23.062-30.875-54.038-55.037-95.835-55.037 c-12.086,0-25.079,2.02-39.045,6.482C22.932,79.249-65.995,260.291,247.94,464.579c2.449,1.595,5.256,2.391,8.062,2.391 s5.613-0.795,8.062-2.391C577.988,260.293,489.06,79.251,404.121,52.066z">
                                </path>
                                <path
                                    d="M510.383,152.815c-4.137-30.776-16.176-59.261-34.818-82.378c-17.247-21.389-39.62-37.288-62.995-44.77 c-17.368-5.547-34.483-8.357-50.885-8.357c-42.575,0-80.229,18.728-107.658,53.144c-30.555-34.913-66.507-52.588-107.078-52.588 c-15.312,0-31.286,2.624-47.479,7.797c-23.395,7.484-45.773,23.384-63.025,44.772C17.797,93.553,5.754,122.039,1.617,152.817 c-6.683,49.719,7.43,103.951,40.817,156.831c38.592,61.125,102.648,121.069,190.388,178.165c6.914,4.499,14.929,6.876,23.18,6.876 c8.251,0,16.266-2.377,23.18-6.876c87.738-57.097,151.792-117.04,190.383-178.168C502.948,256.766,517.063,202.534,510.383,152.815z M256,466.971c-2.806,0-5.613-0.795-8.062-2.391C-65.997,260.293,22.93,79.251,107.905,52.066 c13.966-4.462,26.958-6.482,39.045-6.482c41.797,0,72.773,24.161,95.835,55.037c2.997,4.012,7.485,6.013,11.948,6.013 c4.722,0,9.413-2.242,12.265-6.708c20.861-32.651,52.924-54.895,94.686-54.895c13.192,0,27.358,2.223,42.436,7.037 c84.939,27.185,173.867,208.227-140.059,412.515C261.615,466.176,258.806,466.971,256,466.971z">
                                </path>
                            </g>
                        </svg>

                        <span x-text="likesCount" class="ml-4 text-xl font-bold"></span>
                    </div>
                    @else
                    <div class="mt-4 flex items-center">
                        <svg

                            height="40px" width="40px"  version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 511.999 511.999" xml:space="preserve"
                            fill="#B91C1C">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M404.121,52.066c-15.078-4.814-29.245-7.037-42.436-7.037c-41.763,0-73.826,22.246-94.686,54.895 c-2.851,4.466-7.544,6.708-12.265,6.708c-4.462,0-8.953-1.999-11.948-6.013c-23.062-30.875-54.038-55.037-95.835-55.037 c-12.086,0-25.079,2.02-39.045,6.482C22.932,79.249-65.995,260.291,247.94,464.579c2.449,1.595,5.256,2.391,8.062,2.391 s5.613-0.795,8.062-2.391C577.988,260.293,489.06,79.251,404.121,52.066z">
                                </path>
                                <path
                                    d="M510.383,152.815c-4.137-30.776-16.176-59.261-34.818-82.378c-17.247-21.389-39.62-37.288-62.995-44.77 c-17.368-5.547-34.483-8.357-50.885-8.357c-42.575,0-80.229,18.728-107.658,53.144c-30.555-34.913-66.507-52.588-107.078-52.588 c-15.312,0-31.286,2.624-47.479,7.797c-23.395,7.484-45.773,23.384-63.025,44.772C17.797,93.553,5.754,122.039,1.617,152.817 c-6.683,49.719,7.43,103.951,40.817,156.831c38.592,61.125,102.648,121.069,190.388,178.165c6.914,4.499,14.929,6.876,23.18,6.876 c8.251,0,16.266-2.377,23.18-6.876c87.738-57.097,151.792-117.04,190.383-178.168C502.948,256.766,517.063,202.534,510.383,152.815z M256,466.971c-2.806,0-5.613-0.795-8.062-2.391C-65.997,260.293,22.93,79.251,107.905,52.066 c13.966-4.462,26.958-6.482,39.045-6.482c41.797,0,72.773,24.161,95.835,55.037c2.997,4.012,7.485,6.013,11.948,6.013 c4.722,0,9.413-2.242,12.265-6.708c20.861-32.651,52.924-54.895,94.686-54.895c13.192,0,27.358,2.223,42.436,7.037 c84.939,27.185,173.867,208.227-140.059,412.515C261.615,466.176,258.806,466.971,256,466.971z">
                                </path>
                            </g>
                        </svg>

                        <span class="ml-4 text-xl font-bold">{{ $recipe->likes()->count() }}</span>
                    </div>

                    @endif

                @else

                <div class="mt-4 flex items-center">
                    <svg

                        height="40px" width="40px"  version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 511.999 511.999" xml:space="preserve"
                        fill="#B91C1C">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M404.121,52.066c-15.078-4.814-29.245-7.037-42.436-7.037c-41.763,0-73.826,22.246-94.686,54.895 c-2.851,4.466-7.544,6.708-12.265,6.708c-4.462,0-8.953-1.999-11.948-6.013c-23.062-30.875-54.038-55.037-95.835-55.037 c-12.086,0-25.079,2.02-39.045,6.482C22.932,79.249-65.995,260.291,247.94,464.579c2.449,1.595,5.256,2.391,8.062,2.391 s5.613-0.795,8.062-2.391C577.988,260.293,489.06,79.251,404.121,52.066z">
                            </path>
                            <path
                                d="M510.383,152.815c-4.137-30.776-16.176-59.261-34.818-82.378c-17.247-21.389-39.62-37.288-62.995-44.77 c-17.368-5.547-34.483-8.357-50.885-8.357c-42.575,0-80.229,18.728-107.658,53.144c-30.555-34.913-66.507-52.588-107.078-52.588 c-15.312,0-31.286,2.624-47.479,7.797c-23.395,7.484-45.773,23.384-63.025,44.772C17.797,93.553,5.754,122.039,1.617,152.817 c-6.683,49.719,7.43,103.951,40.817,156.831c38.592,61.125,102.648,121.069,190.388,178.165c6.914,4.499,14.929,6.876,23.18,6.876 c8.251,0,16.266-2.377,23.18-6.876c87.738-57.097,151.792-117.04,190.383-178.168C502.948,256.766,517.063,202.534,510.383,152.815z M256,466.971c-2.806,0-5.613-0.795-8.062-2.391C-65.997,260.293,22.93,79.251,107.905,52.066 c13.966-4.462,26.958-6.482,39.045-6.482c41.797,0,72.773,24.161,95.835,55.037c2.997,4.012,7.485,6.013,11.948,6.013 c4.722,0,9.413-2.242,12.265-6.708c20.861-32.651,52.924-54.895,94.686-54.895c13.192,0,27.358,2.223,42.436,7.037 c84.939,27.185,173.867,208.227-140.059,412.515C261.615,466.176,258.806,466.971,256,466.971z">
                            </path>
                        </g>
                    </svg>

                    <span class="ml-4 text-xl font-bold">{{ $recipe->likes()->count() }}</span>
                </div>

                @endauth

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
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Додати</button>
            </form>
            @else
            <div class="bg-yellow-200 p-4 mt-4">
                <p>Ви не можете коментувати власний рецепт. Це зроблять інші користувачі <span>&#128521;</span></p>
            </div>
            @endif
            @else
            <div class="bg-yellow-200 p-4 mt-4">
                <p>Будь ласка, <a href="{{ route('login') }}" class="text-blue-500 underline">увійдіть</a>, щоб додати
                    коментар або поставити вподобайку</p>
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
                    <button class="text-red-500 font-semibold" type="sumbit"
                        onclick="return confirm('Ви впевнені, що хочете видалити свій коментар?');">Delete</button>
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
