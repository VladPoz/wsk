<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('./bootstrap.min.css')}}">
    <title>ModuleC-2026</title>
</head>
<body>
    <Header class="navbar navbar-dark bg-dark">
        <div class="container flex-row">
            <h1 class="navbar-brand my-1">News</h1>
            <nav class="navbar-nav flex-row gap-5">
                <a class="nav-link" href="{{route('welcome')}}">Новости</a>
                @if(!auth()->check())
                    <a class="nav-link" href="{{route('login')}}">Вход</a>
                @elseif(auth()->user()->role === 'ADMIN')
                    @stack('newsEdit')
                    <a class="nav-link" href="{{route('admin.dashboard')}}">Панель управления</a>
                @endif

                @if(request()->routeIs('admin.dashboard', 'admin.allNews', 'admin.news.create', 'admin.news.edit', 'admin.category', 'admin.category.store', 'admin.category.edit', 'admin.comments'))
                    <a class="nav-link" href="{{route('admin.allNews')}}">Список новостей</a>
                    <a class="nav-link" href="{{route('admin.category')}}">Категории</a>
                    <a class="nav-link" href="{{route('admin.comments')}}">Коментарии</a>
                @endif
            </nav>
        </div>
    </Header>
    <Main>{{$slot}}</Main>
</body>
</html>
