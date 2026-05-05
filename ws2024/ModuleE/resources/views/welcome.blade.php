<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('style.css')}}">
    <title>Welcome</title>
</head>
<body>
    <div class="container">
        <h1 class="title">Polls</h1>
        @foreach($polls as $poll)
            <a class="list__el" href="{{route('poll.index', $poll->slug)}}">{{$poll->title}}</a>
        @endforeach
    </div>
</body>
</html>
