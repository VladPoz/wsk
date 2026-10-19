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
    <main class="main__auth">
        <div class="container">
            <div class="auth__container">
                <form action="" method="post">
                    @csrf
                    <h2><span class="gradient__font">@yield('page__title')</span></h2>
                    @yield('page__content')
                </form>
            </div>
        </div>
    </main>
</body>
</html>
