@extends('layouts.admin')

@section('head')

@endsection

@section('title', 'Админ-панель')

@section('content')
    <div class="content">
        <div class="row px-5">
            <ul class="nav flex-column col-6">
                <li class="left-item">
                    <a class="left-link" href="#">Заявки</a>
                    <p class="left-link-description">Количество: {{ \App\Models\Application::all()->count() }}</p>
                </li>
                <li class="left-item">
                    <a class="left-link" href="#">Обязательства</a>
                    <p class="left-link-description">Количество: {{ \App\Models\Deal::all()->count() }}</p>
                </li>
                <li class="left-item">
                    <a class="left-link" href="#">Пользователи</a>
                </li>
                <li class="left-item">
                    <a class="left-link" href="#">Результаты</a>
                </li>
            </ul>
            <div class="flex-column d-flex col-6">
                <div class="btn-wrapper">
                    <a href="{{ route('admin.expirate') }}" class="button">Экспирация</a>
                    <a href="{{ route('admin.reset') }}" class="button">Сбросить сайт</a>
                </div>
                @expirate
                <h6 id="exprirate">Экспирация: произошла</h6>
                @else
                <h6 id="exprirate">Экспирация: не произошла</h6>
                @endexpirate
            </div>
        </div>
    </div>
@endsection
