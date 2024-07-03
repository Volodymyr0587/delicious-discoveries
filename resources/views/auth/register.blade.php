<x-layout>

<x-slot:heading>
    <h2 class="text-2xl">Реєстрація</h2>
</x-slot:heading>


    <form action="{{ route('register') }}" method="POST" class="max-w-sm mx-auto">
        @csrf
        <div class="mb-5">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Ваше ім'я</label>
            <input type="name" id="name" name="name" value="{{ old('name') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="" required />
            @error('name')
                <span class="mt-4 text-red-500 text-sm">{{ $message }}</span>
            @enderror
          </div>
        <div class="mb-5">
          <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Електронна пошта</label>
          <input type="email" id="email" name="email" value="{{ old('email') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="name@example.com" required />
            @error('email')
                <span class="mt-4 text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-5">
          <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Пароль</label>
          <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
            @error('password')
                <span class="mt-4 text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-5">
            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900">Підтвердження паролю</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
            @error('password_confirmation')
                <span class="mt-4 text-red-500 text-sm">{{ $message }}</span>
            @enderror
          </div>

        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Зареєструватись</button>
      </form>


</x-layout>
