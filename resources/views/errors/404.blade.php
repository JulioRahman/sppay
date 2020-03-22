@extends('layouts.layout')

@section('title')
404
@endsection

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- 404 Error Text -->
    <div class="text-center">
        <div class="error mx-auto" data-text="404">404</div>
        <p class="lead text-gray-800 mb-5">Halaman Tidak Ditemukan</p>
        <p class="text-gray-500 mb-0">Sepertinya Anda menemukan kesalahan dalam matriks ...</p>
        <a href="{{ route('dashboard') }}">&larr; Kembali ke Dasbor</a>
    </div>

</div>
<!-- /.container-fluid -->
@endsection