@extends('base')

@section('title', 'Личный кабинет')

@section('page')
    <div class="page">

        <div class="flex gap-4">
            <a href='/edit-profile'>Редактировать профиль</a>
            <a href="/index">Статьи</a>
            <a href="/logout" class="text-rose-600">Выйти</a>
        </div>

        <div class="profile"> 
            <h1>Личный кабинет</h1>

            @if(!$user->email_verified_at)
                <span class="text-rose-600">● Почта не подтверждена</span>
            @endif

            <label>
                <span>ФИО</span>
                <div>{{$user->name}}</div>
            </label>

            <label>
                <span>Логин</span>
                <div>{{$user->login}}</div>
            </label>

            <label>
                <span>Номер телефона</span>
                <div>{{$user->phone}}</div>
            </label>

            <label>
                <span>Почта</span>
                <div>{{$user->email}}</div>
            </label>
        </div>        
    </div>
@endsection