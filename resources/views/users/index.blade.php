@extends('./components/main')

@section('container')
  <div class="container flex flex-col gap-8">
    <h1 class="text-3xl font-bold text-center">
      Daftar Anggota
    </h1>

    <a href="/users/add" class="bg-blue-500 text-white px-4 py-2 rounded-md w-fit ml-auto">
      Tambah Anggota
    </a>

    @if ($users->count() > 0)
      <div class="grid lg:grid-cols-4 md:grid-cols-3 grid-cols-2 gap-4">
        @foreach ($users as $user)
          <div class="bg-white shadow-sm border rounded-lg p-4">
            <h2 class="text-gray-500">{{ $user->member_id }}</h2>
            <p class="text-lg font-bold">{{ $user->name }}</p>
            <p class="text-gray-500">KTP: {{ $user->card_id }}</p>
            <p class="text-gray-500">tgl lahir: {{ $user->birth_date }}</p>
            <p class="text-gray-500">tgl bergabung: {{ $user->join_date }}</p>

            <form action="/users/{{ $user->id }}" method="POST" class="mt-4">
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
        <p class="">Tidak ada Anggota</p>
      </div>
    @endif
  @endsection
