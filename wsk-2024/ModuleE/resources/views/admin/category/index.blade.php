<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('style.css')}}">
    <title>Categories</title>
</head>
<body>
<div class="container">
    <h1 class="title">Categories</h1>
    <div class="title">
        <a href="{{route('admin.category.create')}}">Create</a>
    </div>
    @foreach($categories as $category)
        <div class="list__el jc_sb">
            <p>{{$category->name}}</p>
            <a href="{{route('admin.category.edit', $category->id)}}">Update</a>
        </div>
    @endforeach
</div>
</body>
</html>
