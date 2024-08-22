@extends('./components/main')

@section('container')
  <div class="container flex flex-col gap-8">
    <h1 class="text-3xl font-bold text-center">
      Tambah Transaksi Pengembalian
    </h1>
    @if (session('error'))
      <div class="bg-red-500 text-white p-4">
        {{ session('error') }}
      </div>
    @endif
    <form action="/returns/add" class="form" method="POST">
      @csrf
      <div class="p-4">
        <label for="user_id" class="block w-full">Anggota</label>
        <input type="text" name="user_id" id="user_id" class="w-full border rounded-md p-2"
          value="{{ $user->id }}" hidden>
        <input type="text" name="name" id="name" class="w-full border rounded-md p-2"
          value="{{ $user->name }}" readonly>

      </div>
      <div class="p-4">
        <label for="book_id" class="block w-full">Buku</label>
        <input type="text" name="book_id" id="book_id" class="w-full border rounded-md p-2"
          value="{{ $book->id }}" hidden>
        <input type="text" name="book" id="book" class="w-full border rounded-md p-2"
          value="{{ $book->title }}" readonly>
      </div>
      <div class="p-4">
        <label for="loan_date" class="block">Tanggal Meminjam</label>
        <input type="date" name="loan_date" id="loan_date" class="w-full border rounded-md p-2"
          value="{{ $loan->loan_date }}" readonly>
      </div>
      <div class="p-4">
        <label for="return_date" class="block">Tanggal Mengembalikan</label>
        <input type="date" name="return_date" id="return_date" class="w-full border rounded-md p-2"
          value="{{ $return_date }}" readonly>
      </div>
      <div class="p-4">
        <label for="price" class="block">Harga</label>
        <input type="number" name="price" id="price" class="w-full border rounded-md p-2"
          value="{{ ($book->price * (strtotime($return_date) - strtotime($loan->loan_date))) / (60 * 60 * 24) }}"
          readonly>
      </div>
      <div class="p-4">
        <button type="submit" class="w-full bg-blue-500 text-white rounded-md p-2">
          Tambah
        </button>
      </div>
    </form>
  @endsection
