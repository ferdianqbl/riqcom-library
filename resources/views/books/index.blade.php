@extends('./components/main')

@section('container')
  <div class="container flex flex-col gap-8">
    <h1 class="text-3xl font-bold text-center">
      Daftar Buku
    </h1>

    <a href="/books/add" class="bg-blue-500 text-white px-4 py-2 rounded-md w-fit ml-auto">
      Tambah Buku
    </a>

    @if ($books->count() > 0)
      <div class="grid lg:grid-cols-4 md:grid-cols-3 grid-cols-2 gap-4">
        @foreach ($books as $book)
          <div class="bg-white shadow-sm border rounded-lg p-4">
            <h2 class="text-xl font-bold">{{ $book->title }}</h2>
            <p class="text-gray-500">Stok: {{ $book->stock }}</p>
            <p class="text-gray-500">Halaman: {{ $book->pages }}</p>
            <p class="text-gray-500">Rp{{ number_format($book->price, 2) }}</p>
            <form action="/books/{{ $book->id }}" method="POST" class="mt-4">
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
        <p class="">Tidak ada buku</p>
      </div>
    @endif
  @endsection
