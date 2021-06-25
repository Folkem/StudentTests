@extends('layouts.app')

@section('title', 'Тестування')

@section('body')
    @include('layouts.header')

    <div class="w-1/2 h-full pt-20 m-auto flex flex-col gap-4">
        <div class="text-center font-bold text-2xl">
            Тестування для групи {{ auth()->user()->group->title }}
        </div>
        @if($testings->count() == 0)
            <div class="text-center mx-auto italic mt-20">
                Нема ніяких тестувань.
            </div>
        @else
            <div class="w-full flex flex-col gap-2 mt-20">
                @foreach($testings as $testing)
                    <div class="w-full p-4 border-gray-200 border-2 rounded-lg flex flex-row">
                        <div class="w-10/12 text-lg flex flex-col gap-2">
                            <div>
                                <b>Назва:</b> {{ $testing->test->title }}
                            </div>
                            <div>
                                <b>Дисципліна:</b> {{ $testing->test->discipline->title }}
                            </div>
                            <div>
                                <b>Почато:</b> {{ $testing->started_at }}
                            </div>
                            <div>
                                <b>Час:</b> {{ $testing->test->time_in_minutes }} хв.
                            </div>
                            <div>
                                <b>Тип контролю:</b> {{ $testing->test->controlType->name }}
                            </div>
                            <div>
                                <b>Кількість балів:</b> {{ $testing->test->grade }}
                            </div>
                            <div>
                                <b>Кількість питань:</b> {{ $testing->test->questions()->count() }}
                            </div>
                        </div>
                        <div class="w-2/12 h-auto my-auto flex flex-col gap-2 justify-center">
                            @if($testing->continues())
                                <a href="{{ route('testings.student.pass', $testing) }}"
                                   class="text-center rounded-md border border-black hover:bg-gray-200">
                                    Почати
                                </a>
                            @else
                                <div class="text-center italic text-gray-400">
                                    Завершено
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
