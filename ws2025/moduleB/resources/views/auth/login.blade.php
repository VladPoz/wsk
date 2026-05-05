<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('style.css')}}">
    <title>Login</title>
</head>
<body>
    <form class="form" method="post" action="{{route('login.submit')}}">
        @csrf
        <div>
            <input type="text" placeholder="Логин" name="login" value="{{old('login')}}">
            <input type="password" placeholder="Праоль" name="password">
            @if($errors->any())
                <p class="err">{{$errors->first()}}</p>
            @endif
            <button type="submit">Войти</button>
        </div>
    </form>
</body>
</html>
