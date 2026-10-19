@extends('layout.auth')

@section('page__title')
    Вход
@endsection

@section('page__content')
    <div>
        <label class="auth__label  @error('email') error__font @enderror" for="name">Email</label>
        <input id="email" name="email"  type="email" class="auth__input  @error('email') error__input @enderror" value="{{old('email')}}" placeholder="exampel@gmail.com">
        <label class="auth__label error__font" for="name">
            @error('email')
            {{ $message }}
            @enderror
        </label>
    </div>
    <div>
        <label class="auth__label  @error('password') error__font @enderror" for="password">Пароль</label>
        <input id="password" name="password" type="password" class="auth__input @error('password') error__input @enderror" placeholder="Минимум 6 символов" maxlength="24">
        <label class="auth__label error__font" for="password">
            @error('password')
            {{ $message }}
            @enderror
            @error('errors')
            {{ $message }}
            @enderror
        </label>
    </div>
    <button class="btn" type="submit">Войти</button>
    <p class="auth__link__el">
        У меня нету аккаунта <span>|</span> <a href="{{route('register')}}"><b>Регистрация</b></a>
    </p>
@endsection
