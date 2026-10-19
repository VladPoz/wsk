<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('./style.css')}}">
    <title>@yield('page__title')</title>
</head>
<body>
    <header>
        <div class="container">
            <div class="header__container">
                <div class="header__logo">FinHub</div>
                <nav class="header__navigate">
                    <a href="{{route('home')}}">Главная</a>
                    <a href="{{route('dashboard')}}">Начать</a>
                    @auth
                        <form action="{{route('logout')}}" method="post">
                            @csrf
                            <button class="btn">Выйти в окно</button>
                        </form>
                    @endauth
                </nav>
            </div>
        </div>
    </header>
    <main>
        @yield('page__content')
    </main>
    <footer>

    </footer>
</body>
</html>
