@extends('layouts.app')

@section('title', 'Результати')

@section('body')
    @include('layouts.header')

    <div class="w-1/2 h-full pt-20 m-auto flex flex-col gap-4">
        <div class="text-center font-bold text-2xl">
            Результати тестування "{{ $testing->test->title }}"
        </div>
        <a class="text-center italic text-xl cursor-pointer rounded-2xl border-gray-400 hover:bg-gray-200 px-4
            hover:border-black border-2 w-max mx-auto" href="{{ route('results.teacher.export', $testing) }}">
            Експортувати звіт у excel?
        </a>
        <div class="w-full flex flex-col gap-2 mt-20">
            <div class="px-16 text-lg">
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
            </div>
            @foreach($results as $result)
                <div class="w-full p-4 border-gray-200 border-2 rounded-lg text-lg flex flex-col gap-2">
                    <div>
                        <b>Студент: </b> {{ $result->user->name }}
                    </div>
                    <div>
                        <b>Кількість балів: </b> {{ $result->grade }}
                    </div>

                    <div class="flex flex-col gap-2">
                        <div class="text-center font-bold text-lg">
                            Обрані відповіді
                        </div>
                        @foreach($result->answers as $answer)
                            <div>
                                {!! $answer->answer->fullBody !!}
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
