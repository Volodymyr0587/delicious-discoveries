<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delicious Discoveries</title>
    <meta name="author" content="Volodymyr Honcharov">
    <meta name="description" content="">

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
    <nav class="w-full py-4 bg-blue-800 shadow">
        <div class="w-full container mx-auto flex flex-wrap items-center justify-between">

            <nav>
                <ul class="flex items-center justify-between font-bold text-sm text-white uppercase no-underline">
                    <li><a class="hover:text-gray-200 hover:underline px-4" href="/">Головна</a></li>
                    <li><a class="hover:text-gray-200 hover:underline px-4" href="#">About</a></li>
                    @auth
                    <li><a class="hover:text-gray-200 hover:underline px-4" href="{{ route('recipes.create') }}">Створити рецепт</a></li>
                    @endauth
                </ul>
            </nav>

            <div class="flex items-center text-lg no-underline text-white pr-6">

                @auth()
                <span class="pl-6 font-bold">
                    {{ auth()->user()->name }}
                </span>
                <form class="pl-6" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="hover:underline">Вийти</button>
                </form>
                @else
                <a class="" href="{{ route('login') }}">
                    Увійти
                </a>

                <a class="pl-6" href="{{ route('register') }}">
                    Зареєструватись
                </a>
                @endauth

                <a class="pl-6" href="#">
                    <i class="fab fa-facebook"></i>
                </a>
                <a class="pl-6" href="#">
                    <i class="fab fa-instagram"></i>
                </a>
                <a class="pl-6" href="#">
                    <i class="fab fa-twitter"></i>
                </a>
                <a class="pl-6" href="#">
                    <i class="fab fa-linkedin"></i>
                </a>
            </div>
        </div>

    </nav>

    <!-- Text Header -->
    <header class="w-full container mx-auto">
        <div class="flex flex-col items-center py-12">
            <a class="font-bold text-gray-800 uppercase hover:text-gray-700 text-5xl" href="{{ route('recipes.index') }}">
                Смачні відкриття
            </a>
            <p class="text-lg text-gray-600 mb-4">
                Кухонні хроніки
            </p>

            @isset($heading)
            {{ $heading }}
            @endisset
        </div>
    </header>

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
