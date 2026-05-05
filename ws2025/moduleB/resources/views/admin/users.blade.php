<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('style.css')}}">
    <title>Users</title>
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
        <form method="post" action="{{route('users.search')}}">
            @csrf
            <input class="search" type="text" name="search" placeholder="search">
        </form>
        @if(session('success'))
            <p class="update result">{{session('success')}}</p>
        @endif
        @if(session('error'))
            <p class="err result">{{session('error')}}</p>
        @endif
        <div class="grid">
            @foreach($users as $user)
                <ul>
                    <li><b>Id: </b>{{$user->id}}</li>
                    <li><b>Имя: </b>{{$user->name}}</li>
                    <li><b>Телефон: </b>{{$user->phone}}</li>
                    <li><b>Email: </b>{{$user->email}}</li>
                    <li><b>Опубликованно: </b>{{$user->published_count}}</li>
                </ul>
            @endforeach
        </div>
    </div>
</main>
</body>
</html>
