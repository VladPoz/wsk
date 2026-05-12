<x-layout>
    <div class="container">
        <div class="row my-3 g-3">
            <p class="fs-4 text-center mb-3">Панель управления администратора: {{$user->name}}</p>
            <div class="col-md-6">
                <form class="card mb-3 p-3" method="post" action="{{route('admin.dashboard.count')}}">
                    @csrf
                    @if(session('news_count'))
                        <p>Количество объявлений в статусе: {{session('news_count')}}</p>
                    @else
                        <p>Количество объявлений в статусе: {{$news_count}}</p>
                    @endif
                    <div class="row">
                        <div class="col-6">
                            <select class="form-select" name="status">
                                @if(session('news_count'))
                                    <option value="{{session('status')}}">Текущий статус</option>
                                @else
                                    <option value="">Все</option>
                                @endif
                                <option value="published">Опубликовано</option>
                                <option value="draft">В обработке</option>
                                <option value="archived">В архиве</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <input type="submit" class="btn btn-dark w-100" value="Обновить">
                        </div>
                    </div>
                </form>
                <div class="card p-3 bg-dark text-light h-100">
                    <p class="fs-5 text-center mb-3">Топ новостей</p>
                    <ol>
                        @forelse($topNews as $topNew)
                            <li class="mb-1">{{$topNew->title}}</li>
                        @empty
                            <p class="text-danger text-center">Нет новостей</p>
                        @endforelse
                    </ol>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card p-3">
                    <p class="fs-5 mx-auto">На обработку</p>
                    @forelse($news_draft as $news_item)
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <p class="mb-0">{{$news_item->title}}</p>
                            <a href="{{route('admin.news.edit', $news_item->id)}}" class="btn btn-dark">Редактировать</a>
                        </div>
                    @empty
                        <p class="text-danger text-center my-auto">Новостей нету</p>
                    @endforelse
                </div>
                <div class="card p-3 my-3 bg-dark text-light">
                    <p class="fs-5 mx-auto">Комментарии на проверку</p>
                    @forelse($comments as $comment)
                        <div class="mb-3">
                            <a href="{{route('news', $comment->news->id)}}" class="btn btn-light">{{$comment->news->title}}</a>
                            <p class="mt-2 mb-0">{{$comment->author}}: {{$comment->body}}</p>
                        </div>
                    @empty
                        <p class="text-danger text-center my-auto">Новостей нету</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-layout>
