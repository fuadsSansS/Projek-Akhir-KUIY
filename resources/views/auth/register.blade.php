{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
@extends('layout.main_auth')
@section('div_auth')
    <div class="col-md-6 right-box">
        <div class="row align-items-center">
            <div class="header-text mb-1">
                <h2>Hello,Again</h2>
                <p>We are happy to have you back.</p>

                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $item)
                            <li style="color: red; "><p>{{ $item }}</p></li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" id="name" name="name"
                        class="form-control form-control-lg bg-light fs-6" placeholder="Your Name">
                </div>
                <div class="input-group mb-3">
                    <input type="text" id="email" name="email"
                        class="form-control form-control-lg bg-light fs-6" placeholder="Email address">
                </div>
                <div class="input-group mb-3">
                    <input type="password" id="password" name ="password" class="form-control form-control-lg bg-light fs-6" required
                        autocomplete="new-password" placeholder="Password">
                </div>
                <div class="input-group mb-3">
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control form-control-lg bg-light fs-6"
                        required autocomplete="new-password" placeholder="Confirm Password">
                </div>
                <div class="input-group mb-3">
                    <button class="btn btn-lg btn-primary w-100 fs-6">Register</button>
                </div>
                <div class="row">
                    <small>Already Account <a href="{{ route('login') }}">LogIn Up</a></small>
                </div>
            </form>
        </div>
    </div>
@endsection
