{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
@extends('layout.main_auth');
@section('div_auth')
    <div class="col-md-6 right-box">
        <div class="row align-items-center">
            <div class="header-text mb-3">
                <h2>Forgot Your Password?</h2>
                <p class="mb-1">We get it, stuff happens.</p>
                <p class="mb-1">Just enter your email address below and </p>
                <p>'ll send you a link to reset your password!</p>
            </div>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" id="email" class="form-control form-control-lg bg-light fs-6" name="email"
                        :value="old('email')" required autofocus placeholder="Email address">
                </div>
                <div class="input-group mb-3">
                    <button class="btn btn-lg btn-primary w-100 fs-6">Reset Password</button>
                </div>
            </form>
        </div>
    </div>
@endsection
