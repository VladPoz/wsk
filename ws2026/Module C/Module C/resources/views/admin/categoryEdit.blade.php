<x-layout>
    <div class="container min-vh-100 d-flex align-items-center justify-content-center">
        <form action="{{route('admin.category.update', $category->id)}}" method="POST" class="card p-5">
            @csrf
            @method('patch')
            <p class="text-center fs-4">Обновление категории</p>
            <input class="form-control mb-3" type="text" placeholder="Название категории" name="name" value="{{$category->name}}">
            @error('name')
            <p class="text-danger mb-3">{{$message}}</p>
            @enderror
            <input class="btn btn-dark mb-3" type="submit" value="Обновить">
        </form>
    </div>
</x-layout>
