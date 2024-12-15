<x-layouts.main class="">
    <main class="flex items-center justify-center min-h-screen">
        <div class="card shadow-2xl bg-base-200 max-w-3xl w-full mx-auto border border-base-300">
            <form action="{{ route('register.store') }}" method="post">
                @csrf
                <div class="card-body space-y-4">
                    <h1 class="text-3xl font-semibold text-center">
                        Register an account
                    </h1>

                    <div class="form-control">
                        <x-text-input
                            label="Email"
                            name="email"
                            type="email"
                            required
                        />

                        @error('email')
                        <span class="text-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-control">
                        <x-text-input
                            label="Name"
                            name="name"
                            required
                        />

                        @error('name')
                        <span class="text-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-control">
                        <x-text-input
                            label="Password"
                            name="password"
                            type="password"
                            required
                        />

                        @error('password')
                        <span class="text-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-control">
                        <x-text-input
                            label="Confirm Password"
                            name="password_confirmation"
                            type="password"
                            required
                        />

                        @error('password_confirmation')
                        <span class="text-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>

                    <p class="text-gray-500 dark:text-gray-400 text-center">
                        <a href="{{ route('login.create') }}" class="link">
                            Already have an account? Login
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </main>
</x-layouts.main>
