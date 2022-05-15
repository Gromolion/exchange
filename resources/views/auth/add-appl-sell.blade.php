@extends('layouts.default')
@section('head')

@endsection
@section('title', 'Добавить заявку на продажу')

@section('content')
    <div class="confrim-appl-content">
        <h1>Добавить заявку на продажу</h1>
        <form action="{{ route('confirm-appl') }}" method="POST" class="confirm-appl-form">
            @csrf
            <input type="hidden" name="type" value="1">

            <label for="count" class="confirm-label">Объем(количество контрактов) шт.</label>
            <input type="number" name="count" id="count" class="confirm-input" min="1" value="{{ old('count') }}">
            <br>
            <label for="price" class="confirm-label">Цена за контракт(тонну) руб.</label>
            <input type="number" name="price" id="price" class="confirm-input" min="1"value="{{ old('price') }}">

            <div class="btn-wrapper mt-4">
                <button type="submit" class="confirm-appl-btn">Создать заявку</button>
            </div>
        </form>
    </div>
@endsection
