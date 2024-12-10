@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Результаты поиска</h1>
        <form action="{{ route('books.search') }}" method="GET">
            <input type="text" name="query" placeholder="Введите запрос" class="border p-2">
            <button type="submit" class="bg-blue-500 text-white p-2">Поиск</button>
        </form>
        <div class="mt-4">
            @if($books->isEmpty())
                <p>Книги не найдены</p>
            @else
                @foreach($books as $book)
                    <div class="border p-2 mb-2">
                        <h2>{{ $book->title }}</h2>
                        <p>Автор: {{ $book->author }}</p>
                        <p>Язык: {{ $book->language }}</p>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
