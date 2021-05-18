@extends('layouts.app')

@section('title', 'Дисципліни')

@section('body')
    @include('layouts.header')

    <div class="w-1/2 h-full pt-20 m-auto flex flex-col gap-4">
        <div class="text-center font-bold text-2xl">
            Дисципліни
        </div>
        <a href="{{ route('disciplines.create') }}"
            class="w-6/12 p-2 bg-green-400 hover:bg-green-500 text-white font-bold mx-auto text-center">
            Додати дисципліну
        </a>
        @if($disciplines->count() == 0)
            <div class="text-center mx-auto italic mt-20">
                Дисциплін ще нема.
            </div>
        @else
            <div class="w-full flex flex-col gap-2 mt-20">
                @foreach($disciplines as $discipline)
                    <div class="w-full p-4 border-gray-200 border-2 rounded-lg flex flex-row">
                        <div class="w-10/12 text-lg flex flex-col gap-2">
                            <div>
                                <b>Назва:</b> {{ $discipline->title }}
                            </div>
                        </div>
                        <div class="w-2/12 flex flex-col gap-2">
                            <div class="py-1 text-center bg-yellow-400 hover:bg-yellow-500 rounded-lg">
                                <a href="{{ route('disciplines.edit', $discipline) }}" class="w-full block">Редагувати</a>
                            </div>
                            <div class="py-1 text-center bg-red-400 hover:bg-red-500 rounded-lg">
                                <form action="{{ route('disciplines.destroy', $discipline) }}" method="post" class="w-full">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="w-full">
                                        Видалити
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
