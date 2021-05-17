@extends('layouts.app')

@section('title', 'Додавання викладача')

@section('body')
    @include('layouts.header')

    <div class="w-full h-full flex">
        <div class="w-3/12 h-auto m-auto flex flex-col gap-4">
            <div class="text-center font-bold text-2xl">
                Додавання викладача
            </div>
            @if($errors->isNotEmpty())
                <div class="bg-gray-200 rounded-lg p-4 flex flex-col gap-1">
                    @foreach($errors->all() as $errorMessage)
                        <div class="text-red-600 text-sm font-bold">
                            {{ $errorMessage }}
                        </div>
                    @endforeach
                </div>
            @elseif(session()->has('message'))
                <div class="bg-green-400 rounded-lg p-4 text-white font-bold text-sm">
                    {{ session('message') }}
                </div>
            @endif
            <form action="{{ route('teachers.store') }}" method="post"
                  class="flex flex-col gap-4">
                @csrf
                <div>
                    <label for="name" class="text-lg pl-2 pb-2">Ім'я: </label>
                    <input type="text" id="name" name="name" required value="{{ old('name') }}" placeholder="Ім'я"
                           class="w-full p-2 border-gray-300 border-2">
                </div>
                <div>
                    <label for="email" class="text-lg pl-2 pb-2">E-mail адреса: </label>
                    <input type="text" id="email" name="email" required value="{{ old('email') }}" placeholder="Пошта"
                           class="w-full p-2 border-gray-300 border-2">
                </div>
                <div>
                    <label for="password" class="text-lg pl-2 pb-2">Пароль: </label>
                    <input type="password" id="password" name="password" required placeholder="Пароль"
                           class="w-full p-2 border-gray-300 border-2">
                </div>
                <div>
                    <label for="password_confirmation" class="text-lg pl-2 pb-2">Підтвердіть пароль: </label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                           required placeholder="Пароль"
                           class="w-full p-2 border-gray-300 border-2">
                </div>
                <div>
                    <button type="submit"
                            class="w-full p-2 bg-blue-400 hover:bg-blue-500 text-white font-bold">
                        Створити
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
