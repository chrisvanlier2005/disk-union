<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

final class ShowDashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $user = $request->user();

        $records = $user->records()
            ->inRandomOrder()
            ->limit(5)
            ->get();

        $totalRecordsCount = $user->records()->count();

        $recentlyAddedRecordsCount = $user->records()
            ->where('created_at', '>', Date::now()->subMonth())
            ->count();

        return view('dashboard', [
            'records' => $records,
            'totalRecordsCount' => $totalRecordsCount,
            'recentlyAddedRecordsCount' => $recentlyAddedRecordsCount,
        ]);
    }
}
