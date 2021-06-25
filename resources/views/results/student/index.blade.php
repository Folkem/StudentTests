@extends('layouts.app')

@section('title', 'Ваші результати')

@section('body')
    @include('layouts.header')

    <div class="w-1/2 h-full pt-20 m-auto flex flex-col gap-4">
        <div class="text-center font-bold text-2xl">
            Ваші результати
        </div>
        @if($results->count() == 0)
            <div class="text-center mx-auto italic mt-20">
                Ви не проходили ніякі тестування.
            </div>
        @else
            <div class="w-full flex flex-col gap-2 mt-20">
                @foreach($results as $result)
                    <div class="w-full p-4 border-gray-200 border-2 rounded-lg text-lg flex flex-col gap-2">
                        <div>
                            <b>Назва тесту:</b> {{ $result->testing->test->title }}
                        </div>
                        <div>
                            <b>Дисципліна:</b> {{ $result->testing->test->discipline->title }}
                        </div>
                        <div>
                            <b>Тип контролю:</b> {{ $result->testing->test->controlType->name }}
                        </div>
                        <div>
                            <b>Почато:</b> {{ $result->testing->started_at }}
                        </div>
                        <div>
                            <b>Кількість питань:</b> {{ $result->testing->test->questions()->count() }}
                        </div>
                        <div>
                            <b>Кількість балів:</b> {{ $result->grade }}
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
