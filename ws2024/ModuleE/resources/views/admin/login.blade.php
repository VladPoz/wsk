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
    <div class="form">
        <form method="post" action="{{route('login.submit')}}" class="display__form" >
            @csrf
            <input type="text" placeholder="name" name="name" value="{{old('name')}}">
            <input type="password" placeholder="password" name="password">
            @if($errors->any())
                <p class="err">{{$errors->first()}}</p>
            @endif
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
