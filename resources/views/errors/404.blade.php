@extends(Auth::guest() ? 'layouts.app' : 'layouts.layout')

@section('title', '404')

@section('content')
<div class="@if(Auth::guest()) jr-centered @endif">
    <div class="@if(Auth::guest()) bg-white @else container-fluid @endif p-5 ">
        <div class="text-center">
            <div class="error mx-auto" data-text="404">404</div>
            <p class="lead text-gray-800 mb-5">Halaman Tidak Ditemukan</p>
            <p class="text-gray-500 mb-0">Sepertinya Anda menemukan kesalahan dalam matriks ...</p>
            @if(!Auth::guest()) <a href="{{ route('dashboard') }}">&larr; Kembali ke Dasbor</a> @endif
        </div>
    </div>
</div>
@endsection
