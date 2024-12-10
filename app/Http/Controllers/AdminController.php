<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UserStat;

class AdminController extends Controller
{
    public function analytics(Request $request)
    {
        $startDate = $request->input('start_date', now()->subMonth());
        $endDate = $request->input('end_date', now());

        $stats = UserStat::whereBetween('accessed_at', [$startDate, $endDate])
            ->with('book', 'user')
            ->get();

        return view('admin.analytics', compact('stats'));
    }
}
