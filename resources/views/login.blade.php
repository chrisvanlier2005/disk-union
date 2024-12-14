<form action="{{ route('login.store') }}" method="post">
    @csrf

    <label for="email">Email</label>
    <input type="email" name="email" id="email" required>

    <label for="password">Password</label>
    <input type="password" name="password" id="password" required>

    @error('email')
        <div>{{ $message }}</div>
    @enderror

    @error('password')
        <div>{{ $message }}</div>
    @enderror

    <button type="submit">Login</button>
</form>

@dump(auth()->user())
