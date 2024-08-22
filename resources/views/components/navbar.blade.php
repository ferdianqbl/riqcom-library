<nav class="container py-4">
  <div class="flex items-center justify-between gap-4">
    <div class="flex items-center justify-center gap-4">
      <a href="/dashboard"
        class="transition-all text-white{{ $active === 'dashboard' ? ' font-medium border-b-2' : '' }}">Dashboard</a>
      <a href="/users"
        class="transition-all text-white{{ $active === 'users' ? ' font-medium border-b-2' : '' }}">Anggota</a>
      <a href="/books"
        class="transition-all text-white{{ $active === 'books' ? ' font-medium border-b-2' : '' }}">Buku</a>
      <a href="/loans"
        class="transition-all text-white{{ $active === 'loans' ? ' font-medium border-b-2' : '' }}">Peminjaman</a>
      <a href="/returns"
        class="transition-all text-white{{ $active === 'returns' ? ' font-medium border-b-2' : '' }}">Pengembalian</a>
    </div>
    <form action="/logout" method="POST">
      @csrf
      <button type="submit"
        class="text-white border rounded-full px-4 py-2 hover:bg-white hover:text-slate-900 transition-all duration-300">
        Logout
      </button>
    </form>
  </div>
</nav>
