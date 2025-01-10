@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Wiki Articles</h1>
        <a href="{{ route('articles.create') }}" class="btn btn-primary">Create New Article</a>
        <ul>
            @foreach ($articles as $article)
                <li>
                    <a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
                    <small>by {{ $article->user->name }}</small>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
