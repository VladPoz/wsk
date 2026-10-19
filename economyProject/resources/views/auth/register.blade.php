@extends('layout.auth')

@section('page__title')
    Регистрация
@endsection

@section('page__content')
    <div>
        <label class="auth__label  @error('name') error__font @enderror" for="name">Имя</label>
        <input id="name" name="name"  type="text" class="auth__input  @error('name') error__input @enderror" value="{{old('name')}}" placeholder="John Smith">
        <label class="auth__label error__font" for="name">
            @error('name')
            {{ $message }}
            @enderror
        </label>
    </div>
    <div>
        <label class="auth__label  @error('email') error__font @enderror" for="email">Email</label>
        <input id="email" name="email"  type="email" class="auth__input  @error('email') error__input @enderror" value="{{old('email')}}" placeholder="exampel@gmail.com">
        <label class="auth__label error__font" for="email">
            @error('email')
                {{ $message }}
            @enderror
        </label>
    </div>
    <div>
        <label class="auth__label  @error('password') error__font @enderror" for="password">Пароль</label>
        <input id="password" name="password" type="password" class="auth__input  @error('password') error__input @enderror" placeholder="минимум 6 символов" maxlength="24">
        <label class="auth__label error__font" for="password">
            @error('password')
                {{ $message }}
            @enderror
            @error('errors')
                {{ $message }}
            @enderror
        </label>
    </div>
    <button class="btn" type="submit">Регистрация</button>
    <p class="auth__link__el">
        У меня есть аккаунт <span>|</span> <a href="{{route('login')}}"><b>Войти</b></a>
    </p>
@endsection
