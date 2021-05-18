@extends('layouts.app')

@section('title', 'Групи')

@section('body')
    @include('layouts.header')

    <div class="w-1/2 h-full pt-20 m-auto flex flex-col gap-4">
        <div class="text-center font-bold text-2xl">
            Групи
        </div>
        <a href="{{ route('groups.create') }}"
            class="w-6/12 p-2 bg-green-400 hover:bg-green-500 text-white font-bold mx-auto text-center">
            Додати групу
        </a>
        @if($groups->count() == 0)
            <div class="text-center mx-auto italic mt-20">
                Груп ще нема.
            </div>
        @else
            <div class="w-full flex flex-col gap-2 mt-20">
                @foreach($groups as $group)
                    <div class="w-full p-4 border-gray-200 border-2 rounded-lg flex flex-row">
                        <div class="w-10/12 text-lg flex flex-col gap-2">
                            <div>
                                <b>Назва:</b> {{ $group->title }}
                            </div>
                        </div>
                        <div class="w-2/12 flex flex-col gap-2">
                            <div class="py-1 text-center bg-yellow-400 hover:bg-yellow-500 rounded-lg">
                                <a href="{{ route('groups.edit', $group) }}">Редагувати</a>
                            </div>
                            <div class="py-1 text-center bg-red-400 hover:bg-red-500 rounded-lg">
                                <form action="{{ route('groups.destroy', $group) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit">
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
