@extends('layouts.app')

@section('title', 'Перегляд тесту')

@section('body')
    @include('layouts.header')

    <div class="w-full h-full flex">
        <div class="w-6/12 mt-20 h-auto m-auto flex flex-col gap-4">
            <div class="text-center font-bold text-2xl">
                Перегляд тесту
            </div>
            <div class="flex flex-col gap-2">
                <div>
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
                </div>
                <div>
                    @if($test->questions->isEmpty())
                        <div class="text-center italic text-lg">
                            Питань нема.
                        </div>
                    @else
                        <div class="text-center font-bold text-xl mb-4">
                            Питання
                        </div>
                        @foreach($test->questions as $question)
                            <div class="mb-8">
                                <div>
                                    <b>Питання №{{ $test->questions->search($question) + 1 }}:</b> {{ $question->body }}
                                </div>
                                <div class="mt-4">
                                    @foreach($question->answers as $answer)
                                        <div>
                                            <i>Відповідь №{{ $question->answers->search($answer) + 1 }}
                                            {{ $answer->is_correct ? '(Правильно) ' : '' }}</i>:
                                            {{ $answer->body }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
