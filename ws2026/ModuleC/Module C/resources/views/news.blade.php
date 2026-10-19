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
                    <p class="text-center fs-5">{{$news->title}}</p>
                    <div class="my-auto d-flex flex-column gap-1">
                        <p>Категория: {{$news->category->name}}</p>
                        <p>Автор: {{$news->author}}</p>
                        <p>Дата публикации: {{$news->created_at}}</p>
                        <p>Просмотров: {{$news->views}}</p>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card p-3">
                    <p class="mb-0">{{$news->body}}</p>
                </div>
            </div>
            <form action="{{route('comment.store', $news->id)}}" method="post">
                @csrf
                <input class="form-control" type="text" placeholder="Коментарий" name="comments" required minlength="3">
            </form>
            @if(session('success'))
                <div class="alert alert-success">
                    <p class="fs-5 mb-0">{{session('success')}}</p>
                </div>
            @endif
            <div class="col-12">
                <div class="card p-3">
                    @forelse($comments as $comment)
                        <div>
                            <p class="mb-1 fs-5">{{$comment->author}}</p>
                            <p class="mb-0">{{$comment->body}}</p>
                        </div>
                    @empty
                        <p class="mb-0">Коментариев нету</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-layout>
