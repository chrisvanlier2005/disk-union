<x-layouts.main>
    <main class="flex items-center justify-center min-h-screen p-2">
        <div class="card shadow-2xl bg-base-200 max-w-3xl w-full mx-auto border border-base-300">
            <form action="{{ route('login.store') }}" method="post">
                @csrf
                <div class="card-body space-y-4">
                    <h1 class="text-3xl font-semibold text-center">
                        Sign in to your account
                    </h1>

                    <div class="form-control">
                        <label for="email" class="label">
                            <span class="label-text">
                                Email
                            </span>
                        </label>

                        <input
                            type="email"
                            name="email"
                            id="email"
                            class="input input-bordered"
                            required
                        >
                    </div>

                    <div class="form-control">
                        <label for="password" class="label">
                            <span class="label-text">
                                Password
                            </span>
                        </label>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="input input-bordered"
                            required
                        >
                    </div>

                    <div class="form-control">
                        <label class="label cursor-pointer">
                            <span class="label-text">Remember me</span>
                            <input type="checkbox" name="remember" value="1" class="checkbox" />
                        </label>
                    </div>

                    @error('email')
                    <span class="text-error">{{ $message }}</span>
                    @enderror

                    @error('password')
                    <div class="text-error">{{ $message }}</div>
                    @enderror

                    <button type="submit" class="btn btn-primary">Login</button>

                    <p class="text-gray-500 dark:text-gray-400 text-center">
                        <a href="{{ route('register.create') }}" class="link">
                            Don't have an account? Register here
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </main>
</x-layouts.main>
