@extends('layouts.default')

@section('title', 'Заявки на продажу')

@section('head')
    <link rel="stylesheet" href="/css/modal.css">
@endsection

@section('content')
    <div class="content">
        @if (session()->has('result'))
            <p class="alert alert-success text-center mx-5">{{ session()->get('result') }}</p>
        @endif
        <h1>Заявки на продажу</h1>
            @include('layouts.filter', ['route' => 'sells'])
            <div class="table-container">
                <table>
                    <thead>
                    <tr>
                        <td>Дата, время выставления заявки</td>
                        <td>Идентификатор участника торгов</td>
                        <td>Объём(количество контрактов)</td>
                        <td>Цена за контракт (тонну), руб</td>
                    </tr>
                    </thead>
                    <tbody class="table_with_modal">
                    @foreach($sells as $sell)
                        <tr id="{{ $sell->id }}">
                            <td>{{ $sell->created_at->format('d M Y G:i') }}</td>
                            <td>{{ $sell->getUser()->getId() }}</td>
                            <td>{{ $sell->count }} шт.</td>
                            <td>{{ $sell->price }}₽</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        <div class="btn-wrapper">
            <a href="{{ route('add-appl-sell') }}" class="button">Добавить заявку</a>
        </div>
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close"><img src="/img/close.svg"></span>
                <p id="modalInfo">Покупка</p>
                <table class="modal-table">
                    <thead>
                    <tr>
                        <td>Дата, время выставления заявки</td>
                        <td>Идентификатор участника торгов</td>
                        <td>Объем (количество контрактов)</td>
                        <td>Цена за контракт (тонну), руб</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="modalrow">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
                <form action="{{ route('deal') }}" method="post" class="data">
                    @csrf
                    <input type="hidden" value="" id="row_id" name="row_id">
                    <div class="d-flex flex-column">
                        <label for="count">Укажите количество</label>
                        <input type="number" id="tentacles" name="count" min="1">
                    </div>
                    <button id="call-btn" type="submit">Купить</button>
                </form>
            </div>
        </div>
        <script src="/js/deal.js"></script>
    </div>
@endsection
