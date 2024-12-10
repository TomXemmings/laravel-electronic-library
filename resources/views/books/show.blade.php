@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $book->title }}</h1>
        <p>Автор: {{ $book->author }}</p>
        <p>Язык: {{ $book->language }}</p>
        <a href="{{ asset('storage/' . $book->file_path) }}" class="bg-blue-500 text-white p-2">Скачать книгу</a>
    </div>
@endsection
