@push('newsEdit')
    <a class="nav-link" href="{{route('admin.news.edit', $news->id)}}">Редактировать</a>
@endpush

<x-layout>
    <div class="container">
        <div class="row mt-3 g-3">
            <div class="col-md-6">
                <img class="w-100 h-100 rounded-3" src="http://127.0.0.1:8000/storage/{{$news->image}}" alt="img">
            </div>
            <div class="col-md-6">
                <div class="card p-3 bg-dark text-light h-100">
                    <p class="fs-4 text-center">{{$news->title}}</p>
                    <p class="fs-5 mb-3">Категория: {{$news->category->name}}</p>
                    <p class="fs-5 mb-3">Автор: {{$news->author}}</p>
                    <p class="fs-5 mb-3">Дата публикации: {{$news->created_at}}</p>
                    <p class="fs-5 mb-0">Просмотров: {{$news->views}}</p>
                    <p></p>
                </div>
            </div>
            <div class="col-12">
                <div class="card p-3">
                    <p class="fs-5 mb-0">{{$news->body}}</p>
                </div>
            </div>
        </div>
    </div>
</x-layout>
