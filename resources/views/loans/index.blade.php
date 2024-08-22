@extends('./components/main')

@section('container')
  <div class="container flex flex-col gap-8">
    <h1 class="text-3xl font-bold text-center">
      Daftar Transaksi Peminjaman
    </h1>

    <a href="/loans/add" class="bg-blue-500 text-white px-4 py-2 rounded-md w-fit ml-auto">
      Tambah Transaksi Peminjaman
    </a>

    @if ($loans->count() > 0)
      <div class="grid lg:grid-cols-4 md:grid-cols-3 grid-cols-2 gap-4">
        @foreach ($loans as $loan)
          <div class="bg-white shadow-sm border rounded-lg p-4">
            <h2 class="text-gray-500">Peminjam: {{ $loan->user->name }}</h2>
            <p class="text-gray-500">Buku: {{ $loan->book->title }}</p>
            <p class="text-gray-500">tgl pinjam: {{ $loan->loan_date }}</p>
            <form action="/loans/{{ $loan->id }}" method="POST" class="mt-4">
              @csrf
              @method('DELETE')
              <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md w-fit ml-auto">
                Hapus
              </button>
            </form>
          </div>
        @endforeach
      </div>
    @else
      <div class="text-center">
        <p class="">Tidak ada transaksi peminjaman.</p>
      </div>
    @endif
  @endsection
