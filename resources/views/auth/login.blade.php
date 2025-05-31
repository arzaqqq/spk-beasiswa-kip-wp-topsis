@extends('layouts.auth')
@section('slot')
    <main class="flex max-w-[335px] w-full flex-col-reverse lg:max-w-4xl lg:flex-row">
        <div class="text-[13px] leading-[20px] flex-1 p-6 pb-12 lg:p-20 bg-white dark:bg-[#161615] dark:text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-bl-lg rounded-br-lg lg:rounded-tl-lg lg:rounded-br-none">
            <h1 class="mb-1 font-medium">Log In</h1>
            <p class="mb-4 text-[#706f6c] dark:text-[#A1A09A]">Enter your credentials to access your account.</p>
            <form method="POST" action="{{ route('login') }}">
                @csrf
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
                <button type="submit" class="px-5 py-1.5 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] rounded-sm border border-black dark:border-[#eeeeec] hover:bg-black dark:hover:bg-white">
                    Log In
                </button>
            </form>
        </div>
    </main>
@endsection
