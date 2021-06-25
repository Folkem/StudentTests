@extends('layouts.app')

@section('title', 'Тести')

@section('body')
    @include('layouts.header')

    <div class="w-1/2 h-full pt-20 m-auto flex flex-col gap-4">
        <div class="text-center font-bold text-2xl">
            Тести
        </div>
        <a href="{{ route('tests.create') }}"
            class="w-6/12 p-2 bg-green-400 hover:bg-green-500 text-white font-bold mx-auto text-center">
            Додати тест
        </a>
        @if($tests->count() == 0)
            <div class="text-center mx-auto italic mt-20">
                Тестів ще нема.
            </div>
        @else
            <div class="w-full flex flex-col gap-2 mt-20">
                @foreach($tests as $test)
                    <div class="w-full p-4 border-gray-200 border-2 rounded-lg flex flex-row">
                        <div class="w-10/12 text-lg flex flex-col gap-2">
                            <div>
                                <b>Назва:</b> {{ $test->title }}
                            </div>
                            <div>
                                <b>Група:</b> {{ $test->group->title }}
                            </div>
                            <div>
                                <b>Дисципліна:</b> {{ $test->discipline->title }}
                            </div>
                            <div>
                                <b>Час:</b> {{ $test->time_in_minutes }} хв.
                            </div>
                            <div>
                                <b>Тип контролю:</b> {{ $test->controlType->name }}
                            </div>
                            <div>
                                <b>Кількість балів:</b> {{ $test->grade }}
                            </div>
                            <div>
                                <b>Кількість питань:</b> {{ $test->questions()->count() }}
                            </div>
                            <div>
                                <b>Створено:</b> {{ $test->created_at }}
                            </div>
                        </div>
                        <div class="w-2/12 h-auto my-auto flex flex-col gap-2">
                            <div class="py-1 text-center bg-green-400 hover:bg-green-500 rounded-lg">
                                <a href="{{ route('tests.show', $test) }}" class="w-full block">Переглянути</a>
                            </div>
                            <div class="py-1 text-center bg-blue-400 hover:bg-blue-500 rounded-lg">
                                <a href="{{ route('testings.teacher.start', $test) }}" class="w-full block">
                                    Розпочати тестування
                                </a>
                            </div>
                            <div class="py-1 text-center bg-red-400 hover:bg-red-500 rounded-lg">
                                <form action="{{ route('tests.destroy', $test) }}" method="post" class="w-full">
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
