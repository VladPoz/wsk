<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('style.css')}}">
    <title>Dashboard</title>
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
                    <button class="logout" type="submit">Выйти</button>
                </form>
            </nav>
        </div>
    </div>
</header>
<main>
    <div class="container">
        <div class="dashboard__info">
            <p><b>Имя пользователя: </b>{{$user->name}}</p>
            <p><b>Опубликованные: </b>{{$published}}</p>
            <p><b>Модерация: </b>{{$moderation}}</p>
            <p><b>Откланённые: </b>{{$declined}}</p>
            <p><b>Количесвто пользвателей: </b>{{$users}}</p>
            <p><b>Популярные: </b></p>
            <ol>
                @foreach($top as $item)
                    <li>{{$item->title}}</li>
                @endforeach
            </ol>
        </div>
    </div>
</main>
</body>
</html>
