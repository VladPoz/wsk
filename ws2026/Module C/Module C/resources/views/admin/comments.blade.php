<x-layout>
    <div class="container">
        <div class="row my-3 g-3">
            @if(session('success'))
                <div class="alert alert-success">
                    <h4 class="text-center">{{session('success')}}</h4>
                </div>
            @endif
            <div class="d-flex flex-column gap-3">
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Автор</th>
                        <th>Новость</th>
                        <th>Содержание</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($comments as $comment)
                        <tr>
                            <td>{{$comment->id}}</td>
                            <td>{{$comment->author}}</td>
                            <td><a class="link-dark" href="{{route('news', $comment->news->id)}}">{{$comment->news->title}}</a></td>
                            <td>{{$comment->body}}</td>
                            <td class="d-flex align-items-center gap-2">
                                <form method="post" action="{{route('admin.comments.update', $comment->id)}}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="submit" class="btn btn-primary" value="Одобрить">

                                </form>
                                <form method="post" action="{{route('admin.comments.delete', $comment->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-danger" value="Удалить">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>
