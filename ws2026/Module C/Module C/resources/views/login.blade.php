<x-layout>
    <div class="container min-vh-100 d-flex align-items-center justify-content-center">
        <form action="{{route('loginSubmit')}}" method="POST" class="card p-5">
            @csrf
            <p class="text-center fs-4">Вход</p>
            <input class="form-control mb-3" type="text" placeholder="Имя пользователя" name="name" value="{{old('name')}}">
            @error('name')
                <p class="text-danger mb-3">{{$message}}</p>
            @enderror
            <input class="form-control mb-3" type="password" placeholder="Пароль" name="password">
            @error('password')
                <p class="text-danger mb-3">{{$message}}</p>
            @enderror
            <input class="btn btn-dark mb-3" type="submit" value="Войти">
        </form>
    </div>
</x-layout>
