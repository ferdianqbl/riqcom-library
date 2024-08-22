@extends('./components/main')

@section('container')
  <div class="container flex flex-col gap-8">
    <h1 class="text-3xl font-bold text-center">
      Tambah Buku
    </h1>

    <form action="/books/add" class="form" method="POST">
      @csrf
      <div class="p-4">
        <label for="title" class="block">Judul Buku</label>
        <input type="text" name="title" id="title" class="w-full border rounded-md p-2">
        @error('title')
          <div class="text-red-500">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="p-4">
        <label for="stock" class="block">Stok</label>
        <input type="number" name="stock" id="stock" class="w-full border rounded-md p-2">
        @error('stock')
          <div class="text-red-500">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="p-4">
        <label for="pages" class="block">Jumlah Halaman</label>
        <input type="number" name="pages" id="pages" class="w-full border rounded-md p-2">
        @error('pages')
          <div class="text-red-500">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="p-4">
        <label for="price" class="block">Harga</label>
        <input type="number" name="price" id="price" class="w-full border rounded-md p-2">
        @error('pages')
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
