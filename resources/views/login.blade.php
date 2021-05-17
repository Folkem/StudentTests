@extends('layouts.app')

@section('title', 'Авторизація')

@section('body')
    <div class="w-full h-full flex">
        <div class="w-3/12 h-auto m-auto p-4 flex flex-col gap-2">
            <div class="text-center text-2xl font-bold">
                Авторизація
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
            <form action="{{ route('login.attempt') }}" method="post"
                  class="flex flex-col gap-4 p-4" autocomplete="on">
                @csrf
                <div class="flex flex-col gap-2">
                    <label for="email" class="text-lg">Ваша пошта: </label>
                    <input type="text" id="email" name="email" autocomplete="email"
                           required placeholder="Пошта"
                           class="w-full p-2 border-gray-300 border-2">
                </div>
                <div class="flex flex-col gap-2">
                    <label for="password" class="text-lg">Ваш пароль: </label>
                    <input type="password" id="password" name="password" autocomplete="password"
                           required placeholder="Пароль"
                           class="w-full p-2 border-gray-300 border-2">
                </div>
                <div>
                    <button type="submit" class="w-full p-2 bg-blue-400 hover:bg-blue-500 text-white font-bold">
                        Увійти
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
