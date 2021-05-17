@extends('layouts.app')

@section('title', 'Вітаємо')

@section('body')
    @include('layouts.header')

    <div class="w-full h-screen flex">
        <div class="w-auto h-auto m-auto text-4xl font-bold">
            Привіт! Ви можете перейти до різних розділів сайту за допомогою
            панелі зверху.
        </div>
    </div>
@endsection
