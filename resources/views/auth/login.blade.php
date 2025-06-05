@extends('layouts.auth')

@section('slot')
    {{-- <main class="flex max-w-[335px] w-full flex-col-reverse lg:max-w-4xl lg:flex-row">
        <div class="flex-1 p-6 pb-12 lg:p-20 bg-white dark:bg-[#161615] dark:text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-bl-lg rounded-br-lg lg:rounded-tl-lg lg:rounded-br-none">
            <!-- Adding the university logo at the top -->
            <div class="flex justify-center mb-6">
                <img src="https://via.placeholder.com/150x150.png?text=University+Logo" alt="University Logo" class="h-20 w-20 lg:h-24 lg:w-24">
            </div>

            <!-- Form container with green accents -->
            <div class="bg-green-50 dark:bg-[#1a2e25] p-6 rounded-lg shadow-md">
                <h1 class="mb-1 font-medium text-lg text-green-800 dark:text-green-200">Log In to University System</h1>
                <p class="mb-4 text-[#706f6c] dark:text-[#A1A09A]">Enter your credentials to access the decision-making system.</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-green-700 dark:text-green-300">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" class="w-full p-2 mt-1 border border-green-300 dark:border-green-600 rounded-md focus:ring-2 focus:ring-green-500 dark:bg-[#2a3b34] dark:text-[#EDEDEC] @error('email') border-[#f53003] focus:ring-[#f53003] @enderror" required>
                        @error('email')
                            <span class="text-[#f53003] text-[13px]">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-green-700 dark:text-green-300">Password</label>
                        <input id="password" type="password" name="password" class="w-full p-2 mt-1 border border-green-300 dark:border-green-600 rounded-md focus:ring-2 focus:ring-green-500 dark:bg-[#2a3b34] dark:text-[#EDEDEC] @error('password') border-[#f53003] focus:ring-[#f53003] @enderror" required>
                        @error('password')
                            <span class="text-[#f53003] text-[13px]">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="w-full px-5 py-2 bg-green-600 dark:bg-green-700 text-white rounded-md border border-green-700 dark:border-green-800 hover:bg-green-700 dark:hover:bg-green-600 transition-colors">
                        Log In
                    </button>
                </form>
            </div>
        </div>
    </main> --}}
     <div class="login-container">
        <div class="login-left">
            <div class="university-logo2">
                <!-- Placeholder untuk logo universitas -->
                {{-- <svg viewBox="0 0 24 24">
                    <path d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z"/>
                </svg> --}}
                <img src="{{ asset('dist/img/logounimal.png') }}" alt="" width="120" >
            </div>
            <div class="welcome-text">
                <h1>Selamat Datang</h1>
                <p>Sistem Pengambilan Keputusan Beasiswa KIP</p>
                <p>Universitas Malikussaleh</p>
            </div>
        </div>

        <div class="login-right">
            <div class="decorative-elements"></div>
            <div class="login-header">
                <h2>Masuk ke Akun Anda</h2>
                <p>Silakan masukkan kredensial Anda untuk mengakses sistem</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        placeholder="Masukkan email Anda"
                        value="{{ old('email') }}"
                        required
                    >
                    <div class="error-message" style="display: none;">
                        Email tidak valid
                    </div>
                     @error('email')
                            <span class="text-[#f53003] text-[13px]">{{ $message }}</span>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        placeholder="Masukkan password Anda"
                        value="{{ old('password') }}"
                        required
                    >
                    <div class="error-message" style="display: none;">
                        Password tidak boleh kosong
                    </div>
                </div>

                <button type="submit" class="login-button">
                    Masuk
                </button>

                <div class="forgot-password">
                   <p>Tidak punya akun?</p> <a href="{{ route('register') }}">Register</a>
                </div>
            </form>
        </div>
    </div>
@endsection
