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
            <div class="w-full flex flex-col md:flex-row md:space-x-4">
                <a class="flex-none text-xl font-semibold dark:text-white hover:text-blue-500 {{ request()->routeIs('recipes.index') ? 'underline underline-offset-8' : ''  }}" href="{{ route('recipes.index') }}">Головна</a>
                <a class="flex-none text-xl font-semibold dark:text-white hover:text-blue-500" href="#">Про нас</a>
                @auth
                <a class="flex-none text-xl font-semibold dark:text-white hover:text-blue-500 {{ request()->routeIs('recipes.create') ? 'underline underline-offset-8' : ''  }}" href="{{ route('recipes.create') }}">Створити рецепт</a>
                @endauth
            </div>


          <div class="flex flex-row items-center gap-5 mt-5 sm:justify-end sm:mt-0 sm:ps-5">
            @auth
                <span class="flex-none text-xl font-bold dark:text-white">{{ auth()->user()->name }}</span>

                <form class="flex-none text-xl font-semibold dark:text-white hover:text-blue-500" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">Вийти</button>
                </form>
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
