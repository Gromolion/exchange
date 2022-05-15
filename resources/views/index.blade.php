@extends('layouts.default')

@section('title', 'Главная страница')

@section('content')
    <div class="pt-4 mt-5 index-content">
        @if (session()->has('result'))
            <p class="alert alert-success text-center mx-5">{{ session()->get('result') }}</p>
        @endif
        @if (session()->has('error'))
            <p class="alert alert-danger text-center mx-5">{{ session()->get('error') }}</p>
        @endif
        <h1>Главная</h1>
        <div class="row justify-content-center index">
            <div class="left-content col-5 py-4">
                <h2 id="index-h">Покупка и продажа фьючерсов на зерно</h2>
                <p id="index-p">Наша биржа предоставляет возможность покупки и продажи фьючерсов на зерно. Полный каталог фьючерсов можно найти в разделе «Список заявок»</p>
                <div class="btn-wrapper">
                    <a href="{{ route('buys') }}" id="index-buy">Купить</a>
                    <a href="{{ route('sells') }}" id="index-sell">Продать</a>
                </div>
            </div>
            <img src="img/index.svg" class="index-img col-8 opacity-100">
        </div>
    </div>
@endsection
