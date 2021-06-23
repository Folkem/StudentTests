@extends('layouts.app')

@section('title', 'Реєстрація')

@section('body')
    <div class="w-full h-full flex">
        <div class="w-3/12 h-auto m-auto p-4 flex flex-col gap-2">
            <div class="text-center text-2xl font-bold">
                Реєстрація
            </div>
            @if($errors->isNotEmpty())
                <div class="bg-gray-200 rounded-lg p-4 flex flex-col gap-1">
                @foreach($errors->all() as $errorMessage)
                    <div class="text-red-600 text-sm font-bold">
                        {{ print_r($errorMessage, true) }}
                    </div>
                @endforeach
                </div>
            @endif
            <form action="{{ route('register.store') }}" method="post"
                  class="flex flex-col gap-4 p-4" autocomplete="on">
                @csrf
                <div class="flex flex-col gap-2">
                    <label for="name" class="text-lg">Ваше ім'я: </label>
                    <input type="text" id="name" name="name" autocomplete="name"
                           required placeholder="Ім'я" value="{{ old('name') }}"
                           class="w-full p-2 border-gray-300 border-2">
                </div>
                <div class="flex flex-col gap-2">
                    <label for="password" class="text-lg">Ваш пароль: </label>
                    <input type="password" id="password" name="password" autocomplete="password"
                           required placeholder="Пароль"
                           class="w-full p-2 border-gray-300 border-2">
                </div>
                <div class="flex flex-col gap-2">
                    <label for="group_id" class="text-lg">Група: </label>
                    <select name="group_id" id="group_id" class="bg-white w-full p-2 border-gray-300 border-2" required>
                        @foreach($groups as $group)
                            <option value="{{ $group->id }}"
                                    @if(old('group_id') == $group->id) selected @endif>
                                {{ $group->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col gap-2">
                    <label for="login.blade.php" class="text-lg">Підтвердіть пароль: </label>
                    <input type="password" id="login.blade.php" name="login.blade.php"
                           autocomplete="password_confirmation"
                           required placeholder="Підтвердження паролю"
                           class="w-full p-2 border-gray-300 border-2">
                </div>
                <div>
                    <button type="submit" class="w-full p-2 bg-blue-400 hover:bg-blue-500 text-white font-bold">
                        Зареєструватися
                    </button>
                </div>
            </form>
            <a href="{{ route('login.index') }}" class="italic text-sm text-center">
                Хочу авторизуватися
            </a>
        </div>
    </div>
@endsection
