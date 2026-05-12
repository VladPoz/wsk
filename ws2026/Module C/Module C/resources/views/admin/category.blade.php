<x-layout>
    <div class="container">
        <div class="row my-3 g-3">
            @if(session('err'))
                <div class="alert alert-danger">
                    <h4 class="text-center">{{session('err')}}</h4>
                </div>
            @endif
            @if(session('success'))
                <div class="alert alert-success">
                    <h4 class="text-center">{{session('success')}}</h4>
                </div>
            @endif
            <a href="{{route('admin.category.create')}}" class="btn btn-dark">Создать</a>
            <div class="d-flex flex-column gap-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название</th>
                            <th>Колличество новостей</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->news_count}}</td>
                                <td class="d-flex align-items-center gap-2">
                                    <a class="btn btn-primary" href={{route('admin.category.edit', $category->id)}}>Редактировать</a>
                                    <form method="post" action="{{route('admin.category.delete', $category->id)}}">
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
