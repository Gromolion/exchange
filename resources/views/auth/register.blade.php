@extends('layouts.auth')

@section('head')
    <link rel="stylesheet" type="text/css" href="/css/reg.css">
@endsection

@section('title', 'Регистрация')

@section('content')
    <h1>Регистрация</h1>
    <form action="" method="POST">
        @csrf

        <label for="name" id="label_name">Название компании</label>
        @error('name')<p id="name_error">{{ $message }}</p>@enderror
        <input type="text" id="input_name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

        <label for="email" id="label_email">Электронная почта</label>
        @error('email')<p id="email_error">{{ $message }}</p>@enderror
        <input id="input_email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">

        <label id="label_password">Пароль</label>
        @error('password')<p id="password_error">{{ $message }}</p>@enderror
        <input type="password" id="input_password" name="password" required autocomplete="new-password">

        <label id="label_password_confirm">Повторите пароль</label>
        @error('password_confirm')<p id="password_confirm_error">{{ $message }}</p>@enderror
        <input type="password" name="password_confirmation" id="input_password_confirm" required autocomplete="new-password">

        <label id="label_check">Я прочитал и принимаю <span>Пользовательское соглашение</span> и <span>Политику конфиденциальности</span></label>
        <input type="checkbox" id="input_check">

        <button id="btn" type="submit">Зарегистрироваться</button>

        <p id="have">У вас уже есть учётная запись?</p>
        <a href="{{ route('login') }}">Вход</a>
    </form>
@endsection
