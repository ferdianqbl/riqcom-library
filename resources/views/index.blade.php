@extends('./components/main')

@section('container')
  <div class="container">
    <h1>
      Welcome, {{ auth()->user()->username }}
    </h1>
  </div>
@endsection
