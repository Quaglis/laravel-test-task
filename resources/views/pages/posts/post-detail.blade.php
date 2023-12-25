@extends('base')

@section('title', $post->title)

@section('page')
    <div class="page">

        <div class="flex gap-4">
            <a href="/profile">Личный кабинет</a>
            <a href="/index">Статьи</a>
            <a href='/post-edit/{{$post->id}}'>Редактировать статью</a>
        </div>

        <div class="detail">
            @if($post['filepath'])
                <div class="image">
                    <img src="/storage/{{$post->filepath}}">
                </div>
            @endif
            <span class="text-xs w-full block text-end">
                просмотры <b>{{count($post->view)}}</b>
            </span>
            <h1 class="text-center">{{$post->title}}</h1>
            <p class="text-start">{{$post->content}}</p>
        </div>  

    </div>
@endsection