<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="{{ asset('public/adminView/custom/loginStyle.css') }}">
</head>
<body>
<div class="login-container">
    <h2>Login</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="input-group">
            <label for="username">Username</label>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div class="input-group">
            <label for="password">Password</label>
            <x-text-input id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <div class="button-group">
            <button type="submit" class="login-btn">Login</button>
        </div>
    </form>
</div>
</body>
</html>
