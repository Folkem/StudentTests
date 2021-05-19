@extends('layouts.app')

@section('title', 'Додавання тесту')

@section('body')
    @include('layouts.header')

    <div class="w-full h-full flex">
        <div class="w-3/12 h-auto m-auto flex flex-col gap-4">
            <div class="text-center font-bold text-2xl">
                Додавання тесту
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
            <form action="{{ route('tests.store') }}" method="post" enctype="multipart/form-data"
                  class="flex flex-col gap-4">
                @csrf
                <div>
                    <label for="title" class="text-lg pl-2 pb-2">Назва: </label>
                    <input type="text" id="title" name="title" required
                           value="{{ old('title') }}" placeholder="Назва"
                           class="w-full p-2 border-gray-300 border-2">
                </div>
                <div>
                    <label for="time_in_minutes" class="text-lg pl-2 pb-2">Час (в хвилинах): </label>
                    <input type="number" id="time_in_minutes" name="time_in_minutes" required
                           value="{{ old('time_in_minutes') }}" placeholder="Час"
                           class="w-full p-2 border-gray-300 border-2">
                </div>
                <div>
                    <label for="grade" class="text-lg pl-2 pb-2">Кількість балів: </label>
                    <input type="number" id="grade" name="grade" required
                           value="{{ old('grade') }}" placeholder="Кількість балів"
                           class="w-full p-2 border-gray-300 border-2">
                </div>
                <div>
                    <label for="discipline" class="text-lg pl-2 pb-2">Дисципліна: </label>
                    <select name="discipline" id="discipline"
                            class="border-2 border-gray-300 rounded-md px-1 py-2 w-full">
                        <option selected></option>
                        @foreach($disciplines as $discipline)
                            <option value="{{ $discipline->id }}"
                                {{ old('discipline') == $discipline->id ? 'selected' : '' }}>
                                {{ $discipline->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="group" class="text-lg pl-2 pb-2">Група: </label>
                    <select name="group" id="group"
                            class="border-2 border-gray-300 rounded-md px-1 py-2 w-full">
                        <option selected></option>
                        @foreach($groups as $group)
                            <option value="{{ $group->id }}"
                                {{ old('group') == $group->id ? 'selected' : '' }}>
                                {{ $group->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="control_type" class="text-lg pl-2 pb-2">Тип контролю: </label>
                    <select name="control_type" id="control_type"
                            class="border-2 border-gray-300 rounded-md px-1 py-2 w-full">
                        <option selected></option>
                        @foreach($controlTypes as $controlType)
                            <option value="{{ $controlType->id }}"
                                {{ old('control_type') == $controlType->id ? 'selected' : '' }}>
                                {{ $controlType->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="questions_file" class="text-lg pl-2 pb-2">Файл з питаннями та відповідями: </label>
                    <input type="file" id="questions_file" name="questions_file" accept="text/plain"
                        class="px-2 py-2">
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
