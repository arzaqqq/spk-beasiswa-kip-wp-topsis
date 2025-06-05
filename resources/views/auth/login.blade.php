@extends('layouts.auth')

@section('slot')

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
                    @error('password')
                        <span class="text-[#f53003] text-[13px]">{{ $message }}</span>
                    @enderror
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
