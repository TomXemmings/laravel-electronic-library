<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Book;
use App\Models\Favorite;
use App\Models\UserStat;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $books = Book::query()
            ->where('title', 'LIKE', "%$query%")
            ->orWhere('author', 'LIKE', "%$query%")
            ->orWhere('language', 'LIKE', "%$query%")
            ->get();

        return view('books.search', compact('books'));
    }

    public function addToFavorites($id)
    {
        $favorite = Favorite::firstOrCreate([
            'user_id' => auth()->id(),
            'book_id' => $id,
        ]);

        return back()->with('success', 'Книга добавлена в избранное!');
    }

    public function removeFromFavorites($id)
    {
        Favorite::where('user_id', auth()->id())
            ->where('book_id', $id)
            ->delete();

        return back()->with('success', 'Книга удалена из избранного!');
    }

    public function favorites()
    {
        $favorites = Favorite::where('user_id', auth()->id())->with('book')->get();

        return view('books.favorites', compact('favorites'));
    }

    public function showBool($id)
    {
        $book = Book::findOrFail($id);

        $userStat = new UserStat();
        $userStat->user_id = Auth::id();
        $userStat->book_id = $book->id;
        $userStat->ip_address = request()->ip();
        $userStat->accessed_at = now();
        $userStat->save();

        // Отобразить книгу
        return view('books.show', compact('book'));
    }
}
