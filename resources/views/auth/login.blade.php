@extends('layouts.auth')
@section('title', 'Войти')
@section('head')
    <link rel="stylesheet" href="/css/login.css">
@endsection

@section('content')
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <h1>Авторизация</h1>
        <label id="label_email">Электронная почта</label>
        <input type="text" id="input_email" name="email">

        <label id="label_password">Пароль</label>
        <input type="password" id="input_password" name="password">

        <button id="btn" type="submit">Войти</button>

        <div class="link">
            <p class="forget">Забыли пароль?</p>
            <a href="">Восстановить</a>
        </div>
        <div class="link">
            <p class="register">Нет аккаунта?</p>
            <a href="{{ route('register') }}">Зарегестрироваться</a>
        </div>
    </form>
@endsection
