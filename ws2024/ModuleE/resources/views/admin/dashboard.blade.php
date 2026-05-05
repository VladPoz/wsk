<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('style.css')}}">
    <title>Admin Dashboard</title>
</head>
<body>
    <div class="container">
        <div class="title">
            <h1>Admin Dashboard</h1>
            <form method="post" action="{{route('admin.logout')}}">
                @csrf
                <button class="title" type="submit">logout</button>
            </form>
        </div>
        <a class="list__el" href="{{route('admin.category.index')}}">Categories</a>
        <a class="list__el" href="{{route('admin.poll.index')}}">Polls</a>
    </div>
</body>
</html>
