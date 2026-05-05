<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('style.css')}}">
    <title>Category</title>
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
        @if(session('success'))
            <p class="update result">{{session('success')}}</p>
        @endif
        @if(session('error'))
            <p class="err result">{{session('error')}}</p>
        @endif
        <div class="grid">
            @foreach($categories as $category)
                <ul>
                    <li><b>Id: </b>{{$category->id}}</li>
                    <li><b>Название: </b>{{$category->name}}</li>
                    <li><b>Опубликованно: </b>{{$category->published_count}}</li>
                    <div>
                        <a class="update" href="{{route('categories.edit', $category->id)}}">Обновить</a>
                        <a class="err" href="{{route('categories.destroy', $category->id)}}">Удалить</a>
                    </div>
                </ul>
            @endforeach
                <ul>
                    <a class="create__link" href="{{route('categories.create')}}">+</a>
                </ul>
        </div>
    </div>
</main>
</body>
</html>
