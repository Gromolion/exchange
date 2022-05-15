<form action="{{ route($route) }}" method="GET">
    <div class="row align-items-center justify-content-around">
        <div class="col-7 mx-5">
            <label for="price_from">Цена от
                <input type="number" min="0" name="price_from" id="price_from" size="6" value="{{ request()->price_from }}">
            </label>
            <label for="price_to">до
                <input type="number" min="1" name="price_to" id="price_to" size="6" value="{{ request()->price_to }}">
            </label>
            <label for="sort">Сортировка
                <select name="sort" id="sort">
                    <option value="created_at DESC" @if(request()->sort === "created_at DESC") selected @endif>новее</option>
                    <option value="created_at ASC" @if(request()->sort === "created_at ASC") selected @endif>старее</option>
                    <option value="count DESC" @if(request()->sort === "count DESC") selected @endif>по убыванию объема</option>
                    <option value="count ASC" @if(request()->sort === "count ASC") selected @endif>по возрастанию объема</option>
                    <option value="price DESC" @if(request()->sort === "price DESC") selected @endif>по убыванию цены</option>
                    <option value="price ASC" @if(request()->sort === "price ASC") selected @endif>возрастанию цены</option>
                </select>
            </label>
        </div>
        <div class="col-4">
            <button type="submit" class="button">Фильтр</button>
            <a href="{{ route($route) }}" class="button">Сбросить</a>
        </div>
    </div>
</form>
