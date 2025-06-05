@extends('layouts.auth')
@section('slot')
    {{-- <main class="flex max-w-[335px] w-full flex-col-reverse lg:max-w-4xl lg:flex-row">
        <div class="text-[13px] leading-[20px] flex-1 p-6 pb-12 lg:p-20 bg-white dark:bg-[#161615] dark:text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-bl-lg rounded-br-lg lg:rounded-tl-lg lg:rounded-br-none">
            <h1 class="mb-1 font-medium">Register</h1>
            <p class="mb-4 text-[#706f6c] dark:text-[#A1A09A]">Create a new account to get started.</p>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm dark:text-[#EDEDEC]">Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" class="w-full p-2 border dark:border-[#3E3E3A] rounded-sm @error('name') border-[#f53003] @enderror" required>
                    @error('name')
                        <span class="text-[#f53003] text-[13px]">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm dark:text-[#EDEDEC]">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" class="w-full p-2 border dark:border-[#3E3E3A] rounded-sm @error('email') border-[#f53003] @enderror" required>
                    @error('email')
                        <span class="text-[#f53003] text-[13px]">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm dark:text-[#EDEDEC]">Password</label>
                    <input id="password" type="password" name="password" class="w-full p-2 border dark:border-[#3E3E3A] rounded-sm @error('password') border-[#f53003] @enderror" required>
                    @error('password')
                        <span class="text-[#f53003] text-[13px]">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm dark:text-[#EDEDEC]">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" class="w-full p-2 border dark:border-[#3E3E3A] rounded-sm" required>
                </div>
                <button type="submit" class="px-5 py-1.5 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] rounded-sm border border-black dark:border-[#eeeeec] hover:bg-black dark:hover:bg-white">
                    Register
                </button>
            </form>
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

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <label for="name">name</label>
                    <input
                        id="name"
                        type="name"
                        name="name"
                        placeholder="Masukkan name Anda"
                        value="{{ old('name') }}"
                        required
                    >
                    <div class="error-message" style="display: none;">
                        name tidak valid
                    </div>
                     @error('name')
                            <span class="text-[#f53003] text-[13px]">{{ $message }}</span>
                        @enderror
                </div>

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

                <div class="form-group">
                    <label for="password_confirmation">password_confirmation</label>
                    <input
                        id="password_confirmation"
                        type="password_confirmation"
                        name="password_confirmation"
                        placeholder="Masukkan password_confirmation Anda"
                        value="{{ old('password_confirmation') }}"
                        required
                    >
                    <div class="error-message" style="display: none;">
                        password confirmation tidak boleh kosong
                    </div>
                </div>



                <button type="submit" class="login-button">
                    Masuk
                </button>

                <div class="forgot-password">
                   <p>Sudah punya akun?</p> <a href="{{ route('login') }}">Login</a>
                </div>
            </form>
        </div>
    </div>
@endsection
