<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('style.css')}}">
    <title>Adverts</title>
</head>
<body>
<header>
    <div class="container">
        <div class="header__content">
            <a href="{{route('welcome')}}">Главная</a>
            <nav>
                <a href="{{route('categories')}}">Категории</a>
                <a href="{{route('adverts')}}">Объявления</a>
                <a href="{{route('users')}}">Пользователи</a>
                <form method="post" action="{{route('logout')}}">
                    @csrf
                    <input class="logout" type="submit" value="Выйти">
                </form>
            </nav>
        </div>
    </div>
</header>
<main>
    <div class="container">
        <form method="post" action="{{route('adverts.search')}}">
            @csrf
            <input class="search" type="text" name="search" placeholder="search">
        </form>
        @if(session('error'))
            <p class="err result">{{session('error')}}</p>
        @endif
        <div class="grid">
            @foreach($adverts as $advert)
                <ul>
                    <li><b>Id: </b>{{$advert->id}}</li>
                    <li><b>Имя: </b>{{$advert->title}}</li>
                    <li><b>Статус: </b>{{$advert->status}}</li>
                </ul>
            @endforeach
        </div>
    </div>
</main>
</body>
</html>
