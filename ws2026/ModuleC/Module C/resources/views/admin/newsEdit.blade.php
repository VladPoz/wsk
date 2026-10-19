<x-layout>
    <div class="container min-vh-100 d-flex align-items-center justify-content-center">
        <form action="{{route('admin.news.update', $news->id)}}" method="POST" class="card p-5" enctype="multipart/form-data">
            @csrf
            <p class="text-center fs-4">Редактировать новость</p>
            <input class="form-control mb-3" type="text" placeholder="Заголовок" name="title" value="{{$news->title}}" required>
            @error('title')
            <p class="text-danger mb-3">{{$message}}</p>
            @enderror
            <input class="form-control mb-3" type="text" placeholder="Автор" name="author" value="{{$news->author}}" required>
            @error('author')
            <p class="text-danger mb-3">{{$message}}</p>
            @enderror
            <select name="category_id" class="form-select mb-3" required>
                <option value="{{$news->category_id}}">Установленная категория</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            @error('category_id')
            <p class="text-danger mb-3">{{$message}}</p>
            @enderror
            <select name="status" class="form-select mb-3" required>
                <option value="{{$news->status}}">Установленный статус</option>
                <option value="draft">draft</option>
                <option value="published">published</option>
                <option value="archived">archived</option>
            </select>
            @error('status')
            <p class="text-danger mb-3">{{$message}}</p>
            @enderror
            <input class="form-control mb-3" type="text" placeholder="Информация" name="body" value="{{$news->body}}" required>
            @error('body')
            <p class="text-danger mb-3">{{$message}}</p>
            @enderror
            <input class="form-control mb-3" type="file" placeholder="Изображение" name="image" required>
            @error('image')
            <p class="text-danger mb-3">{{$message}}</p>
            @enderror
            <input class="btn btn-dark mb-3" type="submit" value="Обновить">
        </form>
    </div>
</x-layout>
