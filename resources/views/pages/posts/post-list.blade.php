@extends('base')

@section('title', 'Статьи')

@section('page')
    <div class="page">

        <div class="flex gap-4">
            <a href='/profile'>Личный кабинет</a>
            <a href="/post-create">Добавить статью</a>
        </div>
     
        @foreach ($posts as $post)
            <div class="post">
                <a class="no-underline" href="/post/{{$post->id}}">
                    <h1>{{$post->title}}</h1>
                </a>
                @if($post['filepath'])
                    <div class="image">
                        <img src="/storage/{{$post->filepath}}">
                    </div>
                @endif
                
                <span class="text-xs w-full block text-end">
                    просмотры <b>{{count($post->view)}}</b>
                </span>
            </div>  
        @endforeach

    </div>
@endsection