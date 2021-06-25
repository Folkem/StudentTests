@extends('layouts.app')

@section('title')
    {{ $testing->test->title }}
@endsection

@section('body')
    @include('layouts.header')

    <div class="w-1/2 h-full pt-20 m-auto flex flex-col gap-4">
        <div class="text-center font-bold text-2xl">
            {{ $testing->test->controlType->name }}
            з дисципліни "{{ $testing->test->discipline->title }}"
        </div>
        @if($questions->count() == 0)
            <div class="text-center mx-auto italic mt-20">
                В даному тестуванні нема питань.
            </div>
        @else
            <div class="fixed top-0 left-0 w-1/4 h-full flex">
                <div class="m-auto w-max text-5xl" id="time-left" data-seconds="{{ $testing->leftSeconds }}">
                    {{ intdiv($testing->leftSeconds, 60) }} : {{ $testing->leftSeconds % 60 }}
                </div>
            </div>

            <div class="w-full flex flex-col gap-2 mt-20">
                <form action="{{ route('testings.student.end', $testing) }}"
                      method="post" class="flex flex-col gap-4 pb-20">
                    @csrf
                    @foreach($questions as $question)
                        <div class="w-full p-4 border-gray-200 border-2 rounded-lg flex flex-col">
                            <div>
                                <b>Питання:</b> {{ $question->body }}
                            </div>
                            @foreach($question->answers as $answer)
                                <label>
                                    <input type="radio" name="{{ $question->id }}" value="{{ $answer->id }}" required>
                                    {{ $answer->body }}
                                </label>
                            @endforeach
                        </div>
                    @endforeach
                    <button type="submit" class="rounded-lg px-4 py-2 text-lg bg-green-500 hover:bg-green-600">
                        Завершити
                    </button>
                </form>
            </div>
        @endif
    </div>

    <script>
        const timeLeftBlock = document.querySelector('#time-left');
        let timeLeft = {{ $testing->leftSeconds }};
        const timeLeftTimer = setInterval(() => {
            timeLeft--;

            if (timeLeft > 0) {
                const minutesLeft = (timeLeft / 60) | 0;
                const secondsLeft = timeLeft % 60;
                timeLeftBlock.innerHTML = minutesLeft + ' : ' + (secondsLeft < 10 ? '0' : '') + secondsLeft;
            } else {
                clearInterval(timeLeftTimer);
                timeLeftBlock.innerHTML = 'ЗАВЕРШЕНО';
            }
        }, 1000);
    </script>
@endsection
