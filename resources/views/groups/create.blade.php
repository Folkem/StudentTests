@extends('layouts.app')

@section('title', 'Додавання групи')

@section('body')
    @include('layouts.header')

    <div class="w-full h-full flex">
        <div class="w-3/12 h-auto m-auto flex flex-col gap-4">
            <div class="text-center font-bold text-2xl">
                Додавання групи
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
            <form action="{{ route('groups.store') }}" method="post"
                  class="flex flex-col gap-4">
                @csrf
                <div>
                    <label for="title" class="text-lg pl-2 pb-2">Назва: </label>
                    <input type="text" id="title" name="title" required value="{{ old('title') }}" placeholder="Назва"
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
