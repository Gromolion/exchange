<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/default.css">
    @yield('head')
    <title>@yield('title')</title>
</head>
<body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-light py-2 px-4 fs-5">
        <div class="container">
            <a href="{{ route('index')}}" class="navbar-brand"><img src="/img/logo.svg" alt="жыбий рыр" id="logo"></a>
            <div class="collapse navbar-collapse justify-content-center">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a href="{{ route('index') }}" class="nav-link fw-bold">Главная</a>
                    </li>
                    <li class="nav-item dropdown mx-5">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle fw-bold" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Список заявок
                        </a>

                        <ul class="dropdown-menu dropdown-menu-start mx-5" style="background-color: #FF8C00;" aria-labelledby="navbarDropdown">
                            <li><a href="{{ route('sells') }}" class="dropdown-item" style="background-color: #FF8C00;">На продажу</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a href="{{ route('buys') }}" class="dropdown-item" style="background-color: #FF8C00;">На покупку</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a href="{{ route('obligations') }}" class="nav-link fw-bold">Обязательства участников</a></li>
                </ul>
            </div>
            <div class="profile d-flex align-content-center">
                <ul class="navbar-nav">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link fw-bold" href="{{ route('login') }}">Войти</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link fw-bold" href="{{ route('register') }}">Регистрация</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item"><a href="{{ route('profile') }}" class="nav-link fw-bold"><img src="/img/profile.svg" alt=""></a></li>
                    @admin
                        <li class="nav-item d-flex align-items-center"><a href="{{ route('admin.index') }}" class="nav-link fw-bold">Админ-панель</a></li>
                    @endadmin
                        <li class="nav-item d-flex align-items-center"><a href="{{ route('logout') }}" class="nav-link fw-bold">Выйти</a></li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
