<x-layout>
    <div class='container my-3'>
        <div class="row g-3">
            <form class="row g-3 w-100" action="{{route('welcome')}}" method="GET">
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
            </form>
            @foreach($news as $item)
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                    <a href="{{route('news', $item->id)}}" class="card p-3 shadow h-100 text-decoration-none">
                        <img class="mb-3 rounded-2" height="200px" src="http://127.0.0.1:8000/storage/{{$item->image}}" alt="img">
                        <p class="fs-5 mb-1">{{$item->title}}</p>
                        <p class="fs-5 mb-1">Категория: {{$item->category->name}}</p>
                        <p class="fs-5 mb-1">Автор: {{$item->author}}</p>
                        <p class="fs-5 mb-1">Дата публикации: {{$item->created_at}}</p>
                        <p class="fs-5 mb-0">Просмотров: {{$item->views}}</p>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>
