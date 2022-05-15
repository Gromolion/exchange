@extends('layouts.default')

@section('title', 'Обязательства участников')

@section('head')

@endsection

@section('content')
    <div class="content">
        <h1>Обязательства участников</h1>
        @include('layouts.filter', ['route' => 'obligations'])
        <div class="table-container">
            <table>
                <thead>
                <tr>
                    <td>Дата, время заключения сделки</td>
                    <td>Идентификатор покупателя(принимающего зерно)</td>
                    <td>Идентификатор продавца(поставщика зерна)</td>
                    <td>Объём в контрактах</td>
                    <td>Цена за контракт (тонну), руб</td>
                </tr>
                </thead>
                <tbody>
                @foreach($deals as $deal)
                    <tr>
                        <td>{{ $deal->created_at->format('d M Y G:i') }}</td>
                        <td>{{ $deal->getBuyer()->getId() }}</td>
                        <td>{{ $deal->getSeller()->getId() }}</td>
                        <td>{{ $deal->count }} шт.</td>
                        <td>{{ $deal->price }}₽</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
