<x-layout>
    <div class="container min-vh-100 d-flex align-items-center justify-content-center">
        <form action="{{route('admin.category.store')}}" method="POST" class="card p-5">
            @csrf
            <p class="text-center fs-4">Создать категорию</p>
            <input class="form-control mb-3" type="text" placeholder="Название категории" name="name" value="{{old('name')}}">
            @error('name')
            <p class="text-danger mb-3">{{$message}}</p>
            @enderror
            <input class="btn btn-dark mb-3" type="submit" value="Создать">
        </form>
    </div>
</x-layout>
