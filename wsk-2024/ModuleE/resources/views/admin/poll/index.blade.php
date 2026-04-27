<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('style.css')}}">
    <title>Polls</title>
</head>
<body>
<div class="container">
    <h1 class="title">Polls</h1>
    <div class="title">
        <a href="{{route('admin.poll.create')}}">Create</a>
    </div>
    @if(session('success'))
        <p>{{session('success')}}</p>
    @endif
    @foreach($polls as $poll)
        <div class="list__el jc_sb">
            <p>{{$poll->title}}</p>
            <div>
                <a href="{{route('admin.poll.edit', $poll->id)}}">Update</a>
                <a href="{{route('admin.poll.delete', $poll->id)}}">Delete</a>
            </div>
        </div>
    @endforeach
</div>
</body>
</html>
