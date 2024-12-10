@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Аналитика</h1>

        <form action="{{ route('admin.analytics') }}" method="GET">
            <label for="start_date">Начальная дата:</label>
            <input type="date" name="start_date" id="start_date" value="{{ request()->input('start_date') }}">
            <label for="end_date">Конечная дата:</label>
            <input type="date" name="end_date" id="end_date" value="{{ request()->input('end_date') }}">
            <button type="submit" class="bg-blue-500 text-white p-2">Показать статистику</button>
        </form>

        <table class="table mt-4">
            <thead>
            <tr>
                <th>Книга</th>
                <th>Пользователь</th>
                <th>IP-адрес</th>
                <th>Дата и время</th>
            </tr>
            </thead>
            <tbody>
            @foreach($stats as $stat)
                <tr>
                    <td>{{ $stat->book->title }}</td>
                    <td>{{ $stat->user ? $stat->user->name : 'Не зарегистрирован' }}</td>
                    <td>{{ $stat->ip_address }}</td>
                    <td>{{ $stat->accessed_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
