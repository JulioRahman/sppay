@extends('layouts.app')

@section('title', 'Lupa Kata Sandi')

@section('content')
<!-- Outer Row -->
<div class="row justify-content-center">

    <div class="col-xl-5 col-lg-6 col-md-4">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-5">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-2">Lupa Kata Sandi Anda?</h1>
                    <p class="mb-4">Kami mengerti, banyak hal terjadi. Cukup masukkan alamat email Anda di bawah ini dan kami akan
                        mengirimkan Anda tautan untuk mereset kata sandi Anda!</p>
                </div>

                <form class="user" method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-group">
                        <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="email"
                            aria-describedby="emailHelp" placeholder="Alamat Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Setel Ulang Kata Sandi
                    </button>
                </form>

                <hr width="10%">

                <div class="text-center">
                    <a class="small" href="{{ route('login') }}">Sudah memiliki akun? Masuk!</a>
                </div>

                <div class="text-center">
                    <a class="small" href="{{ route('register') }}">Daftar akun siswa</a>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
