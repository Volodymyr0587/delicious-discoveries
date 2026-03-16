<x-layout>

    <!-- Categories -->
    <x-categories-nav :categories="$categories" :categoryId="$categoryId" />

    <x-search-bar />

    <div class="container mx-auto flex flex-wrap py-6">

        <!-- Recipes Section -->
        <section class="w-full md:w-2/3 flex flex-col items-center px-3">

            @forelse ($recipes as $recipe)
                <article class="flex flex-col shadow my-4">
                    <!-- Recipes Image -->
                    <a href="{{ route('recipes.show', $recipe) }}" class="hover:opacity-75">
                        <img src="{{ $recipe->image ? asset('storage/' . $recipe->image) : asset('images/food.jpg') }}">
                    </a>
                    <div class="bg-white flex flex-col justify-start p-6">
                        <a href="{{ route('recipes.index', ['category_id' => $recipe->category->id]) }}"
                            class="text-blue-700 text-sm font-bold uppercase pb-4">{{ $recipe->category->name }}</a>
                        <a href="{{ route('recipes.show', $recipe) }}"
                            class="text-3xl font-bold hover:text-gray-700 pb-4 first-letter:text-7xl capitalize">{{ $recipe->name }}</a>
                        <p class="text-sm pb-3">
                            Від <a href="{{ route('user.recipes', $recipe->user) }}"
                                class="font-semibold hover:text-gray-800 underline">{{ $recipe->user->name }}</a>
                            Створено {{ $recipe->created_at->locale('uk')->diffForHumans() }}.
                            Сподобалось <span class="font-semibold">{{ $recipe->likes()->count() }}</span>
                        </p>
                        <p>Переглядів <span class="font-semibold">{{ $recipe->views }}</span></p>
                        <a href="{{ route('recipes.show', $recipe) }}"
                            class="pb-6">{{ Str::limit($recipe->description, 40) }}</a>
                        <a href="{{ route('recipes.show', $recipe) }}"
                            class="uppercase text-gray-800 hover:text-black">Продовжити читати
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </article>
            @empty
                <div class="my-4 font-semibold text-2xl">
                    No Recipes
                    <x-svg.no-recipes />
                </div>
            @endforelse

            <div class="space-x-8 py-8">
                {{ $recipes->appends(['category_id' => request('category_id')])->links() }}
            </div>
        </section>

        <!-- Sidebar Section -->
        <aside class="w-full md:w-1/3 flex flex-col items-center px-3">

            <div class="w-full bg-white shadow flex flex-col my-4 p-6">
                <p class="text-xl font-semibold pb-5">About Us</p>
                <p class="pb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas mattis est eu odio
                    sagittis tristique. Vestibulum ut finibus leo. In hac habitasse platea dictumst.</p>
                <a href="#"
                    class="w-full bg-blue-800 text-white font-bold text-sm uppercase rounded hover:bg-blue-700 flex items-center justify-center px-2 py-3 mt-4">
                    Get to know us
                </a>
            </div>

            <div class="w-full bg-white shadow flex flex-col my-4 p-6">
                <p class="text-xl font-semibold pb-5">Instagram</p>
                <div class="grid grid-cols-3 gap-3">
                    <img class="hover:opacity-75" src='https://picsum.photos/id/10/150/150'>
                    <img class="hover:opacity-75" src='https://picsum.photos/id/20/150/150'>
                    <img class="hover:opacity-75" src='https://picsum.photos/id/30/150/150'>
                    <img class="hover:opacity-75" src='https://picsum.photos/id/40/150/150'>
                    <img class="hover:opacity-75" src='https://picsum.photos/id/50/150/150'>
                    <img class="hover:opacity-75" src='https://picsum.photos/id/60/150/150'>
                    <img class="hover:opacity-75" src='https://picsum.photos/id/70/150/150'>
                    <img class="hover:opacity-75" src='https://picsum.photos/id/80/150/150'>
                    <img class="hover:opacity-75" src='https://picsum.photos/id/90/150/150'>
                </div>
                <a href="#"
                    class="w-full bg-blue-800 text-white font-bold text-sm uppercase rounded hover:bg-blue-700 flex items-center justify-center px-2 py-3 mt-6">
                    <i class="fab fa-instagram mr-2"></i> Follow @delicious-discoveries
                </a>
            </div>

        </aside>

    </div>

    <footer class="w-full border-t bg-white pb-6">
        <div class="relative w-full overflow-hidden" x-data="carousel()" x-init="init()">

            <!-- Left arrow -->
            <button
                class="absolute top-1/2 left-2 transform -translate-y-1/2 bg-blue-800 hover:bg-blue-700 text-white text-2xl font-bold rounded-full w-12 h-12 flex items-center justify-center z-10"
                @click="prev()">
                &#8592;
            </button>

            <!-- Right arrow -->
            <button
                class="absolute top-1/2 right-2 transform -translate-y-1/2 bg-blue-800 hover:bg-blue-700 text-white text-2xl font-bold rounded-full w-12 h-12 flex items-center justify-center z-10"
                @click="next()">
                &#8594;
            </button>

            <!-- Carousel track -->
            <div class="flex transition-transform duration-500" :style="`transform: translateX(-${currentOffset}px)`">
                <template x-for="(image, index) in visibleImages" :key="index">
                    <div class="flex-shrink-0 px-1 w-1/6 md:w-1/6 sm:w-1/3">
                        <img :src="image" loading="lazy"
                            class="w-full h-56 object-cover rounded-md shadow-md hover:opacity-80" alt="Recipe Image">
                    </div>
                </template>
            </div>
        </div>
    </footer>

    <script>
        function carousel() {
            return {
                images: [
                    '{{ asset('images/dessert.jpg') }}',
                    '{{ asset('images/dessert2.jpg') }}',
                    '{{ asset('images/drink-with-straw.jpg') }}',
                    '{{ asset('images/fish.jpg') }}',
                    '{{ asset('images/fried-eggs-whit-bacon.jpg') }}',
                    '{{ asset('images/hamburger.jpg') }}',
                    '{{ asset('images/ice-cream.jpg') }}',
                    '{{ asset('images/meat-with-vegetables.jpg') }}',
                    '{{ asset('images/oysters.jpg') }}',
                    '{{ asset('images/pizza.jpg') }}',
                    '{{ asset('images/salad.jpg') }}',
                    '{{ asset('images/sandwich.jpg') }}',
                ],
                currentIndex: 0,
                itemWidth: 0,
                visibleImages: [],
                init() {
                    this.updateVisible();
                    window.addEventListener('resize', () => this.updateVisible());
                },
                updateVisible() {
                    // Кількість картинок на екрані
                    const screenWidth = window.innerWidth;
                    let itemsOnScreen = 6;
                    if (screenWidth < 768) itemsOnScreen = 3;
                    if (screenWidth < 480) itemsOnScreen = 2;

                    this.visibleImages = this.getSlice(this.currentIndex, itemsOnScreen);
                    this.itemWidth = document.querySelector('.flex-shrink-0')?.offsetWidth || 200;
                },
                getSlice(start, count) {
                    // Infinite loop slice
                    const result = [];
                    for (let i = 0; i < count; i++) {
                        result.push(this.images[(start + i) % this.images.length]);
                    }
                    return result;
                },
                next() {
                    this.currentIndex = (this.currentIndex + 1) % this.images.length;
                    this.updateVisible();
                },
                prev() {
                    this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
                    this.updateVisible();
                },
                get currentOffset() {
                    return 0; // використовуємо transform для плавного scroll
                }
            }
        }
    </script>
</x-layout>
