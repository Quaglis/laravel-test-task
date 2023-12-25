@extends('base')

@section('title', 'Авторизация')

@section('page')
    <div class="flex justify-center p-3"> 
        <form method="post" action="authentication">
            @csrf
            
            <h1>Авторизация</h1>

            <div>
                @error('email') <div>{{ $message }}</div> @enderror
                <input type="text" name="email" placeholder="Почта" required>
            </div>

            <div>
                @error('password') <div>{{ $message }}</div> @enderror
                <input type="password" name="password" placeholder="Пароль" required>
            </div>
        
            <button>Войти</button>

            <a href='/register'>регистрация</a>
        </form>
    </div>
@endsection