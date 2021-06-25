@extends('layouts.app')

@section('title', 'Результати')

@section('body')
    @include('layouts.header')

    <div class="w-1/2 h-full pt-20 m-auto flex flex-col gap-4">
        <div class="text-center font-bold text-2xl">
            Результати
        </div>
        @if($testings->count() == 0)
            <div class="text-center mx-auto italic mt-20">
                Ніяких тестувань не було проведено.
            </div>
        @else
            <div class="w-full flex flex-col gap-2 mt-20">
                @foreach($testings as $testing)
                    <div class="w-full p-4 border-gray-200 border-2 rounded-lg text-lg flex flex-col gap-2">
                        <div>
                            <b>Назва тесту:</b> {{ $testing->test->title }}
                        </div>
                        <div>
                            <b>Дисципліна:</b> {{ $testing->test->discipline->title }}
                        </div>
                        <div>
                            <b>Тип контролю:</b> {{ $testing->test->controlType->name }}
                        </div>
                        <div>
                            <b>Група:</b> {{ $testing->test->group->title }}
                        </div>
                        <div>
                            <b>Почато:</b> {{ $testing->started_at }}
                        </div>
                        <div>
                            <b>Кількість питань:</b> {{ $testing->test->questions()->count() }}
                        </div>
                        <div>
                            <b>Максимальна кількість балів:</b> {{ $testing->test->grade }}
                        </div>
                        <div>
                            <a href="{{ route('results.teacher.show', $testing) }}"
                                class="hover:bg-gray-200 rounded-md p-1 border-2 border-black">
                                Переглянути відповіді
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
