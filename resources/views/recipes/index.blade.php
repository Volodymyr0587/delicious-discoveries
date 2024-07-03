<x-layout>

    <!-- Categories -->
    <x-categories-nav :categories="$categories" :category_id="$category_id" />



    <div class="container mx-auto flex flex-wrap py-6">

        <!-- Recipes Section -->
        <section class="w-full md:w-2/3 flex flex-col items-center px-3">

            @forelse ($recipes as $recipe)
            <article class="flex flex-col shadow my-4">
                <!-- Recipes Image -->
                <a href="#" class="hover:opacity-75">
                    <img src="{{$recipe->image ? asset('storage/' . $recipe->image) : asset('images/food.jpg') }}">
                </a>
                <div class="bg-white flex flex-col justify-start p-6">
                    <a href="#" class="text-blue-700 text-sm font-bold uppercase pb-4">Technology</a>
                    <a href="#" class="text-3xl font-bold hover:text-gray-700 pb-4">Lorem Ipsum Dolor Sit Amet Dolor Sit
                        Amet</a>
                    <p href="#" class="text-sm pb-3">
                        By <a href="#" class="font-semibold hover:text-gray-800">David Grzyb</a>, Published on April
                        25th, 2020
                    </p>
                    <a href="#" class="pb-6">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus quis porta
                        dui. Ut eu iaculis massa. Sed ornare ligula lacus, quis iaculis dui porta volutpat. In sit amet
                        posuere magna..</a>
                    <a href="#" class="uppercase text-gray-800 hover:text-black">Continue Reading <i
                            class="fas fa-arrow-right"></i></a>
                </div>
            </article>
            @empty
                <div class="my-4">
                    No Recipes
                </div>
            @endforelse




            <!-- Pagination -->
            <div class="flex items-center py-8">
                <a href="#"
                    class="h-10 w-10 bg-blue-800 hover:bg-blue-600 font-semibold text-white text-sm flex items-center justify-center">1</a>
                <a href="#"
                    class="h-10 w-10 font-semibold text-gray-800 hover:bg-blue-600 hover:text-white text-sm flex items-center justify-center">2</a>
                <a href="#"
                    class="h-10 w-10 font-semibold text-gray-800 hover:text-gray-900 text-sm flex items-center justify-center ml-3">Next
                    <i class="fas fa-arrow-right ml-2"></i></a>
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
                    <i class="fab fa-instagram mr-2"></i> Follow @dgrzyb
                </a>
            </div>

        </aside>

    </div>

    <footer class="w-full border-t bg-white pb-6">
        <div class="relative w-full flex items-center invisible md:visible md:pb-12" x-data="getCarouselData()">
            <button
                class="absolute left-0 bg-blue-800 hover:bg-blue-700 text-white text-2xl font-bold hover:shadow rounded-full w-16 h-16 ml-12 flex justify-center items-center z-10"
                x-on:click="decrement()">
                &#8592;
            </button>

            <template x-for="image in images.slice(currentIndex, currentIndex + 6)" :key="images.indexOf(image)">
                <img class="w-1/6 hover:opacity-75" :src="image">
            </template>
            <button
                class="absolute right-0 bg-blue-800 hover:bg-blue-700 text-white text-2xl font-bold hover:shadow rounded-full w-16 h-16 mr-12"
                x-on:click="increment()">
                &#8594;
            </button>
        </div>
    </footer>

    <script>
        function getCarouselData() {
            return {
                currentIndex: 0,
                images: [
                    'https://picsum.photos/id/' + getRandomInt(1, 1000) + '/800/800',
                    'https://picsum.photos/id/' + getRandomInt(1, 1000) + '/800/800',
                    'https://picsum.photos/id/' + getRandomInt(1, 1000) + '/800/800',
                    'https://picsum.photos/id/' + getRandomInt(1, 1000) + '/800/800',
                    'https://picsum.photos/id/' + getRandomInt(1, 1000) + '/800/800',
                    'https://picsum.photos/id/' + getRandomInt(1, 1000) + '/800/800',
                    'https://picsum.photos/id/' + getRandomInt(1, 1000) + '/800/800',
                    'https://picsum.photos/id/' + getRandomInt(1, 1000) + '/800/800',
                    'https://picsum.photos/id/' + getRandomInt(1, 1000) + '/800/800',
                    'https://picsum.photos/id/' + getRandomInt(1, 1000) + '/800/800',
                    'https://picsum.photos/id/' + getRandomInt(1, 1000) + '/800/800',
                    'https://picsum.photos/id/' + getRandomInt(1, 1000) + '/800/800',
                ],
                increment() {
                    this.currentIndex = this.currentIndex === this.images.length - 6 ? 0 : this.currentIndex + 1;
                },
                decrement() {
                    this.currentIndex = this.currentIndex === 0 ? this.images.length - 6 : this.currentIndex - 1;
                },
            }
        }

        function getRandomInt(min, max) {
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }
    </script>


</x-layout>
