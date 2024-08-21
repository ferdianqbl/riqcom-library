<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>
    Login Admin
  </title>
  @vite('resources/css/app.css')
</head>

<body>
  <main class="container h-screen flex items-center justify-center">
    <div class="border rounded-md w-full md:w-3/4 lg:w-[400px]">
      <h1 class="text-center text-3xl font-bold p-4">Login Admin</h1>
      @if (session('status'))
        <div class="bg-red-500 text-white p-4">
          {{ session('status') }}
        </div>
      @endif
      <form action="/" class="form" method="POST">
        @csrf
        <div class="p-4">
          <label for="username" class="block">Username</label>
          <input type="text" name="username" id="username" class="w-full border rounded-md p-2">
          @error('username')
            <div class="text-red-500">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="p-4">
          <label for="password" class="block">Password</label>
          <input type="password" name="password" id="password" class="w-full border rounded-md p-2">
          @error('password')
            <div class="text-red-500">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="p-4">
          <button type="submit" class="w-full bg-blue-500 text-white rounded-md p-2">Login</button>
        </div>
      </form>
      <div class="p-4">
        Don't have an account?
        <a href="{{ route('register') }}" class="text-blue-500">Register</a>
      </div>
    </div>
  </main>
</body>

</html>
