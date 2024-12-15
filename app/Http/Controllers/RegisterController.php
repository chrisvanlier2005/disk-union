<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

final class RegisterController extends Controller
{
    public function create(): View
    {
        return view('register');
    }

    public function store(RegisterRequest $request): RedirectResponse
    {
        $user = new User();
        $user->name = $request->validated('name');
        $user->email = $request->validated('email');
        $user->password = $request->validated('password');
        $user->save();

        Auth::login($user);

        return redirect()->intended();
    }
}
