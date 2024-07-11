<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delicious Discoveries</title>
    <meta name="author" content="Volodymyr Honcharov">
    <meta name="description" content="">
    <link rel="icon" href="{{ asset('cooking-food-fried.ico') }}">

    <!-- Tailwind -->
    @vite('resources/css/app.css')
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

        .font-family-karla {
            font-family: karla;
        }
    </style>

    <!-- AlpineJS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
</head>
<body class="bg-white font-family-karla">

    <!-- Top Bar Nav -->
    <header class="flex flex-wrap sm:justify-start sm:flex-nowrap w-full bg-white text-sm py-4 dark:bg-neutral-800">
        <nav class="max-w-[85rem] w-full mx-auto px-4 sm:flex sm:items-center sm:justify-between" aria-label="Global">
            <div class=" flex flex-col md:flex-row items-center md:space-x-4">
                <a class="flex-none" href="{{ route('recipes.index') }}">
                    <img class="h-10 w-10" src="{{ asset('images/cooking-food-fried.png') }}" alt="">
                </a>
                <a class="flex-none text-xl font-semibold dark:text-white hover:text-blue-500 {{ request()->routeIs('recipes.index') ? 'underline underline-offset-8' : ''  }}" href="{{ route('recipes.index') }}">Головна</a>
                <a class="flex-none text-xl font-semibold dark:text-white hover:text-blue-500" href="#">Про нас</a>
                @auth
                <a class="flex-none text-xl font-semibold dark:text-white hover:text-blue-500 {{ request()->routeIs('recipes.create') ? 'underline underline-offset-8' : ''  }}" href="{{ route('recipes.create') }}">Створити рецепт</a>
                @endauth
            </div>


          <div class="flex flex-col md:flex-row items-center md:space-x-4">
            @auth
                <div x-data="{ open: false }" @click.away="open = false" class="relative inline-block text-left">
                    <!-- User Name -->
                    <div @click="open = !open" class="flex items-center gap-2 hover:text-blue-500 dark:text-white cursor-pointer">
                        <span  class="flex-none text-xl font-bold">
                            {{ auth()->user()->name }}
                        </span>
                        <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mt-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 5.25 7.5 7.5 7.5-7.5m-15 6 7.5 7.5 7.5-7.5" />
                        </svg>
                        <svg x-show="open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mt-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 18.75 7.5-7.5 7.5 7.5" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 7.5-7.5 7.5 7.5" />
                        </svg>
                    </div>
                    <!-- Dropdown Menu -->
                    <div x-show="open" x-transition class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg dark:text-white dark:bg-neutral-800 dark:ring-lime-300  ring-2 ring-black ring-opacity-5">
                        <div class="py-1">
                            <a href="{{ route('user.recipes', auth()->user()) }}" class="block px-4 py-2 text-xl text-left hover:text-blue-500 font-semibold cursor-pointer">Мої рецепти</a>
                        </div>
                        <div class="py-1">
                            <form action="{{ route('logout') }}" method="POST" class="block px-4 py-2 text-xl font-semibold cursor-pointer">
                                @csrf
                                <button type="submit" class="w-full text-left hover:text-blue-500">Вийти</button>
                            </form>
                        </div>
                    </div>
                </div>

            @else
                <a class="flex-none text-xl font-semibold dark:text-white hover:text-blue-500 {{ request()->routeIs('login') ? 'underline underline-offset-8' : ''  }}" href="{{ route('login') }}">Увійти</a>
                <a class="flex-none text-xl font-semibold dark:text-white hover:text-blue-500 {{ request()->routeIs('register') ? 'underline underline-offset-8' : ''  }}" href="{{ route('register') }}">Зареєструватись</a>
            @endauth
          </div>
        </nav>
      </header>

    <!-- Text Header -->
    <div class="w-full container mx-auto">
        <div class="flex flex-col items-center py-12">
            <h1 class="font-bold text-neutral-800 uppercase text-5xl">
                Смачні відкриття
            </h1>
            <p class="text-lg text-gray-600 mb-4">
                Кухонні хроніки
            </p>

            @isset($heading)
            {{ $heading }}
            @endisset
        </div>
    </div>

    {{ $slot }}


    <footer class="w-full border-t bg-white pb-12 mt-20">
        <div class="w-full container mx-auto flex flex-col items-center">
            <div class="flex flex-col md:flex-row text-center md:text-left md:justify-between py-6">
                <a href="#" class="uppercase px-3">Про нас</a>
                <a href="#" class="uppercase px-3">Політика конфіденційності</a>
                <a href="#" class="uppercase px-3">Правила та умови</a>
                <a href="#" class="uppercase px-3">Зв'яжіться з нами</a>
            </div>
            <div class="uppercase pb-6">&copy; delicious-discoveries.com</div>
        </div>
    </footer>
</body>
</html>
