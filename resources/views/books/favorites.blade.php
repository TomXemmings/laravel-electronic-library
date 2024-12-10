@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Избранное</h1>
        <div class="mt-4">
            @forelse($favorites as $favorite)
                <div class="border p-2 mb-2">
                    <h2>{{ $favorite->book->title }}</h2>
                    <p>Автор: {{ $favorite->book->author }}</p>
                    <p>Язык: {{ $favorite->book->language }}</p>
                    <form action="{{ route('books.favorites.remove', $favorite->book->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white p-2">Удалить</button>
                    </form>
                </div>
            @empty
                <p>У вас пока нет избранных книг</p>
            @endforelse
        </div>
    </div>
@endsection
