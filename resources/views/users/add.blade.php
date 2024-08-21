@extends('./components/main')

@section('container')
  <div class="container flex flex-col gap-8">
    <h1 class="text-3xl font-bold text-center">
      Tambah Anggota
    </h1>

    <form action="/users/add" class="form" method="POST">
      @csrf
      <div class="p-4">

        <label for="name" class="block">Nama</label>
        <input type="text" name="name" id="name" class="w-full border rounded-md p-2">
        @error('name')
          <div class="text-red-500">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="p-4">
        <label for="card_id" class="block">KTP</label>
        <input type="text" name="card_id" id="card_id" class="w-full border rounded-md p-2">
        @error('card_id')
          <div class="text-red-500">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="p-4">
        <label for="birth_date" class="block">Tanggal Lahir</label>
        <input type="date" name="birth_date" id="birth_date" class="w-full border rounded-md p-2">
        @error('birth_date')
          <div class="text-red-500">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="p-4">
        <label for="join_date" class="block">Tanggal Bergabung</label>
        <input type="date" name="join_date" id="join_date" class="w-full border rounded-md p-2">
        @error('join_date')
          <div class="text-red-500">
            {{ $message }}
          </div>
        @enderror
      </div>

      <div class="p-4">
        <button type="submit" class="w-full bg-blue-500 text-white rounded-md p-2">Tambah</button>
      </div>
    </form>
  @endsection
