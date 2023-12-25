@extends('base')

@section('title', 'Регистрация')

@section('page')
    <div class="flex justify-center p-3">
        <form method="post" action="registration">
            @csrf

            <h1>Регистрация</h1>

            <div>
                @error('name') <div>{{ $message }}</div> @enderror
                <input type="text" name="name" placeholder="ФИО" required>
            </div>
            
            <div>
                @error('login') <div>{{ $message }}</div> @enderror
                <input type="text" name="login" placeholder="Логин" required
                    title="Должен содержать хоть 1 цифру, буквы латинские">
            </div>

           <div>
                @error('phone') <div>{{ $message }}</div> @enderror
                <input type="text" name="phone" placeholder="Номер телефона" required
                    title="Минимум 1 заглавная буква, минимум 1 цифра">
            </div>

            <div>
                @error('email') <div>{{ $message }}</div> @enderror
                <input type="text" name="email" placeholder="Почта" required>
            </div>
            
            <div>
                @error('password') <div>{{ $message }}</div> @enderror
                <input type="password" name="password" placeholder="Пароль" required>
            </div>

            <div>
                <input type="password" name="password_confirmation" 
                placeholder="Подтверждение пароля" required>
            </div>
        
            <button>Зарегистрироваться</button>
            
            <a href='/login'>авторизация</a>
        </form>
    </div>

@endsection