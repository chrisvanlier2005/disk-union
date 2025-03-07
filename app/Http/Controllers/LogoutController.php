<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

final class LogoutController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        Auth::logout();

        $session = $request->session();
        $session->invalidate();
        $session->regenerateToken();

        return redirect()->route('login');
    }
}
