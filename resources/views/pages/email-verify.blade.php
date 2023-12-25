@extends('base')

@section('title', 'Авторизация')

@section('page')
    <div class="flex justify-center p-3"> 
        <div class="info">
            
            <h1>Подтвердите свою электронную почту!</h1>
            
            <p>
                При регистрации, на вашу почту было отправлено сообщение.
                Что бы подтвердить свою почту необходимо перейти по ссылке в сообщении.
            </p>

            <div class="flex gap-3 justify-center">
                <a href='/profile'>Личный кабинет</a>
                <a href='/index'>Статьи</a>
            </div>
        </div>
    </div>
@endsection