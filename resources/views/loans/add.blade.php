@extends('./components/main')

@section('container')
  <div class="container flex flex-col gap-8">
    <h1 class="text-3xl font-bold text-center">
      Tambah Transaksi Peminjaman
    </h1>
    @if (session('error'))
      <div class="bg-red-500 text-white p-4">
        {{ session('error') }}
      </div>
    @endif
    <form action="/loans/add" class="form" method="POST">
      @csrf
      <div class="p-4">
        <label for="user_id" class="block w-full">Anggota</label>
        <select name="user_id" id="user_id" class="block w-full border rounded-md p-2">
          <option value="">Pilih Anggota</option>
          @foreach ($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
          @endforeach
        </select>
        @error('user_id')
          <div class="text-red-500">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="p-4">
        <label for="book_id" class="block w-full">Buku</label>
        <select name="book_id" id="book_id" class="block w-full border rounded-md p-2">
          <option value="">Pilih Buku</option>
          @foreach ($books as $book)
            <option value="{{ $book->id }}">{{ $book->title }}</option>
          @endforeach
        </select>
        @error('book_id')
          <div class="text-red-500">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="p-4">
        <label for="loan_date" class="block">Tanggal Meminjam</label>
        <input type="date" name="loan_date" id="loan_date" class="w-full border rounded-md p-2">
        @error('loan_date')
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
