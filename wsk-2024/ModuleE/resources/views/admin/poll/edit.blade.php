<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('style.css')}}">
    <title>Poll Update</title>
</head>
<body>
<div class="form">
    <form method="post" action="{{route('admin.poll.update', $poll->id)}}" class="display__form" >
        @csrf
        <select name="category_id">
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
        <input type="text" placeholder="title" name="title" value="{{$poll->title}}">
        <input type="text" placeholder="description" name="description" value="{{$poll->description}}">
        @if($errors->any())
            <p>{{$errors->first()}}</p>
        @endif
        <button type="submit">Update</button>
    </form>
</div>
</body>
</html>
