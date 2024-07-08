@props(['categories', 'category_id'])

<nav class="w-full py-4 border-t border-b bg-gray-100" x-data="{ open: false }">
    <div class="block sm:hidden">
        <a
            href="#"
            class="block md:hidden text-base font-bold uppercase text-center  justify-center items-center"
            @click="open = !open"
        >
            Категорії <i :class="open ? 'fa-chevron-down': 'fa-chevron-up'" class="fas ml-2"></i>
        </a>
    </div>
    <div :class="open ? 'block': 'hidden'" class="w-full flex-grow sm:flex sm:items-center sm:w-auto">
        <div class="w-full container mx-auto flex flex-col sm:flex-row items-center justify-center text-sm font-bold uppercase mt-0 px-6 py-2">

            <div class="flex items-center py-2 px-2 mx-2">
                <a href="{{ route('recipes.index') }}" class="hover:bg-gray-400 rounded py-2 px-4 mx-2 {{ is_null($category_id) ? 'bg-gray-400' : '' }}">
                    Всі
                </a>
                <span class="font-bold ml-1 px-2 py-1 rounded-md bg-lime-300">{{ App\Models\Recipe::count() }}</span>
            </div>

            @foreach ($categories as $category)
            <div class="flex items-center py-2 px-2 mx-2">
                <a href="{{ route('recipes.index', ['category_id' => $category->id]) }}" class="hover:bg-gray-400 rounded py-2 px-2  {{ $category_id == $category->id ? 'bg-gray-400' : '' }}">
                    {{ $category->category_name }}
                </a>
                <span class="font-bold ml-1 px-2 py-1 rounded-md {{ $loop->iteration % 2 == 0 ? 'bg-lime-300' : 'bg-amber-300' }}">{{ $category->recipes()->count() }}</span>
            </div>
            @endforeach
        </div>
    </div>
</nav>
