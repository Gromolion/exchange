@extends('layouts.default')

@section('title', ' Ваш профиль')

@section('head')
    <link rel="stylesheet" href="/css/tabs.css">
    <link rel="stylesheet" href="/css/modal.css">
@endsection

@section('content')
    <div class="content">
        <h1>Личный кабинет</h1>
        <div class="info">
            <h3 id="profile-id">{{ Auth::user()->getId() }}</h3>
            <h2 id="profile-name">{{ Auth::user()->name }}</h2>
        </div>
        <ul id="tabs">
            @expirate
            @if(count($results) != 0)
            <li id="s1" class="selector">Финальные результаты</li>
            @endif
            <li id="s2" class="selector">Финальные обязательства</li>
            @else
                @if(count($results) != 0)
                <li id="s1" class="selector">Результаты</li>
                @endif
                <li id="s2" class="selector">
                    Мои обязательства
                </li>
                <li id="s3" class="selector">
                    Обязательства мне
                </li>
                @endexpirate
        </ul>
        <div class="table-container">
            @if(count($results) != 0)
            <table class="dtable hide" id="t1">
                <thead>
                <tr>
                    <td>Дата и время начисления финансового результата</td>
                    <td>Финансовый результат, руб</td>
                </tr>
                </thead>
                <tbody>
                @foreach($results as $result)
                    <tr>
                        <td>{{ $result->created_at->format('d M Y G:i') }}</td>
                        <td>{{ $result->result }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td>Общий фин. результат</td>
                    <td>{{ $results_total }}</td>
                </tr>
                </tbody>
            </table>
            @endif
            @expirate
                <table class="dtable hide" id="t2">
                    <thead>
                        <tr>
                            <td>Дата, время заключения сделки</td>
                            <td>Идентификатор покупателя</td>
                            <td>Идентификатор продавца</td>
                            <td>Объём в контрактах</td>
                            <td>Цена за контракт (тонну), руб</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($deals as $deal)
                        <tr>
                            <td>{{ $deal->created_at->format('d M Y G:i') }}</td>
                            <td>{{ $deal->buyer_id }}</td>
                            <td>{{ $deal->seller_id }}</td>
                            <td>{{ $deal->count }} шт.</td>
                            <td>{{ $deal->price }}₽</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <table class="dtable hide" id="t2">
                    <thead>
                    <tr>
                        <td>Дата, время заключения сделки</td>
                        <td>Идентификатор покупателя</td>
                        <td>Идентификатор продавца</td>
                        <td>Объём в контрактах</td>
                        <td>Цена за контракт (тонну), руб</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sells as $sell)
                        <tr>
                            <td>{{ $sell->created_at->format('d M Y G:i') }}</td>
                            <td>{{ $sell->buyer_id }}</td>
                            <td>{{ $sell->seller_id }}</td>
                            <td>{{ $sell->count }} шт.</td>
                            <td>{{ $sell->price }}₽</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <table class="dtable hide" id="t3">
                    <thead>
                    <tr>
                        <td>Дата, время заключения сделки</td>
                        <td>Идентификатор покупателя</td>
                        <td>Идентификатор продавца</td>
                        <td>Объём в контрактах</td>
                        <td>Цена за контракт (тонну), руб</td>
                    </tr>
                    </thead>
                    <tbody class="table_with_modal">
                    @foreach($buys as $buy)
                        <tr id="{{$buy->id }}">
                            <td>{{ $buy->created_at->format('d M Y G:i') }}</td>
                            <td>{{ $buy->buyer_id }}</td>
                            <td>{{ $buy->seller_id }}</td>
                            <td>{{ $buy->count }} шт.</td>
                            <td>{{ $buy->price }}₽</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div id="myModal" class="modal">
                    <div class="profile-modal-content">
                        <span class="close"><img src="/img/close.svg"></span>
                        <p id="modalInfo">Перепродажа</p>
                        <table class="modal-table">
                            <thead>
                            <tr>
                                <td>Дата, время выставления заявки</td>
                                <td>Идентификатор покупателя</td>
                                <td>Идентификатор продавца</td>
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
                        <form action="{{ route('resell') }}" method="post" class="data">
                            @csrf
                            <input type="hidden" value="" id="row_id" name="row_id">
                            <div class="d-flex flex-column">
                                <label for="count">Укажите количество</label>
                                <input type="number" id="count" name="count" min="1">
                            </div>
                            <div class="d-flex flex-column">
                                <label for="price">Укажите цену</label>
                                <input type="number" id="price" name="price" min="1">
                            </div>
                            <button id="call-btn" type="submit">Перепродать</button>
                        </form>
                    </div>
                </div>
                @endexpirate
        </div>
    </div>
    <script src="/js/deal.js"></script>
    <script src="/js/tabs.js"></script>
@endsection
