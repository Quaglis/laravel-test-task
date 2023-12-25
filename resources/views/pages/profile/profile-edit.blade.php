@extends('base')

@section('title', 'Личный кабинет')

@section('page')
    <div class="page">

        <div class="flex gap-4">
            <a href="/profile">Личный кабинет</a>
            <a href="/index">Статьи</a>
            <a href="/logout" class="text-rose-600">Выйти</a>
        </div>

        <form method="post" action="/api/edit-profile">
            @csrf

            <h1>Редактировать данные</h1>

            <div>
                @error('name') <div>{{ $message }}</div> @enderror
                <input type="text" name="name" placeholder="ФИО" required value="{{$user->name}}">
            </div>
            
            <div>
                @error('login') <div>{{ $message }}</div> @enderror
                <input type="text" name="login" placeholder="Логин" required value="{{$user->login}}"
                    title="Должен содержать хоть 1 цифру, буквы латинские">
            </div>

           <div>
                @error('phone') <div>{{ $message }}</div> @enderror
                <input type="text" name="phone" placeholder="Номер телефона" value="{{$user->phone}}"
                required title="Минимум 1 заглавная буква, минимум 1 цифра">
            </div>

            <div>
                @error('email') <div>{{ $message }}</div> @enderror
                <input type="text" name="email" placeholder="Почта" required value="{{$user->email}}">
            </div>
        
            <button>Сохранить</button>
        </form>
        

        <form method="post" action="/api/edit-password">
            @csrf

            <h1>Изменить пароль</h1>

            <div>
                @error('old_password') <div class="">{{ $message }}</div> @enderror
                <input type="password" name="old_password" placeholder="Старый пароль" required>
            </div>

            <div>
                @error('new_password') <div class="">{{ $message }}</div> @enderror
                <input type="password" name="new_password" placeholder="Новый пароль" required>
            </div>
        
            <button>Изменить</button>
        </form>
    </div>
@endsection