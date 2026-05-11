<x-layout>
    <div class='container my-3'>
        <div class="row g-3">
            <form class="row g-3 w-100" action="{{route('admin.allNews')}}" method="GET">
                <div class="col-lg-8">
                    <input name="search" placeholder="Поиск" class="form-control">
                </div>
                <div class="col-lg-3">
                    <select name="category_id" class="form-select">
                        <option value="">Все категории</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-1">
                    <input class="btn btn-dark w-100" type="submit" value="Поиск">
                </div>
                <div class="col-lg-12">
                    <a href="{{route('admin.news.create')}}" class="btn btn-dark w-100">Создать</a>
                </div>
            </form>
            @foreach($news as $item)
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                    <div class="card p-3 shadow h-100 text-decoration-none">
                        <img class="mb-3 rounded-2" height="200px" src="http://127.0.0.1:8000/storage/{{$item->image}}" alt="img">
                        <p class="fs-5 mb-1">{{$item->title}}</p>
                        <p class="fs-5 mb-1">Категория: {{$item->category->name}}</p>
                        <p class="fs-5 mb-1">Автор: {{$item->author}}</p>
                        <p class="fs-5 mb-1">Дата публикации: {{$item->created_at}}</p>
                        <p class="fs-5 mb-1">Просмотров: {{$item->views}}</p>
                        <a class="btn btn-dark w-100 mb-1" href="{{route('news', $item->id)}}">Посетить</a>
                        <a class="btn btn-dark w-100" href="{{route('admin.news.edit', $item->id)}}">Редактировать</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>
