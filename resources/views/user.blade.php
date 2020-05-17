@extends('layouts.layout')

@section('title', 'Manajemen ' . ucwords($role))

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ ucwords($role) }}</h1>
    </div>

    <div class="row">

        <div class="col-lg-5">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary" id="title">Tambah {{ ucwords($role) }}</h6>
                </div>
                <div class="card-body">
                    <form id="formUser">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                placeholder=""  name="name" value="{{ old('name') }}" required autocomplete="name">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                placeholder=""  name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-row" id="formPassword">
                            <div class="form-group col">
                                <label for="password">Kata Sandi</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" placeholder="" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col">
                                <label for="password-confirm">Ulangi Kata Sandi</label>
                                <input type="password" class="form-control"
                                    id="password-confirm" placeholder=""  name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <input type="hidden" name="role" value="{{ strtoupper($role) }}" />

                        <button id="btnSubmit" type="submit" class="btn btn-primary float-right">Simpan</button>
                        <button id="btnReset" type="reset" class="btn btn-danger float-right mr-2"
                            style="display: none">Batal</button>
                    </form>
                </div>
            </div>

        </div>

        <div class="col-lg-7">

            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
<!-- /.container-fluid -->
@endsection

@push('scripts')
<script>
    $(document).ready( function () {
        var isCreate = true;
        var userId;
        var type;
        var url;
        var msg;

        var table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ $role }}/json',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            "columnDefs": [{
                "targets": -1,
                "data": null,
                "defaultContent": "<a href='' class='pr-2' id='editData'><i class='fas fa-edit'></i></a>" +
                    "<a href='' id='deleteData'><i class='fas fa-trash'></i></a>"
            }],
            "language": {
                "sEmptyTable":   "Tidak ada data yang tersedia pada tabel ini",
                "sProcessing":   "Sedang memproses...",
                "sLengthMenu":   "Tampilkan _MENU_ entri",
                "sZeroRecords":  "Tidak ditemukan data yang sesuai",
                "sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                "sInfoEmpty":    "Tidak ada data yang tersedia",
                "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                "sInfoPostFix":  "",
                "sSearch":       "Cari:",
                "sUrl":          "",
                "oPaginate": {
                    "sFirst":    "|<",
                    "sPrevious": "<",
                    "sNext":     ">",
                    "sLast":     ">|"
                }
            },
            "initComplete": function( settings, json ) {
                $('#dataTable tbody').on( 'click', '#editData', function(e) {
                    e.preventDefault();

                    var data = table.row( $(this).parents('tr') ).data();
                    $("#formUser input[name=name]").val(data.name).focus();
                    $("#formUser input[name=email]").val(data.email);
                    isCreate = false;
                    userId = data.id;
                    $("#title").html("Sunting {{ ucwords($role) }}");
                    $("#btnSubmit").html("Ubah");
                    $("#btnReset").show();
                    $("#formPassword").hide();
                    $("#formUser input[name=password]").prop("required", false);
                    $("#formUser input[name=password_confirmation]").prop("required", false);
                });

                $('#dataTable tbody').on( 'click', '#deleteData', function(e) {
                    e.preventDefault();

                    var data = table.row( $(this).parents('tr') ).data();
                    Swal.fire({
                        title: 'Apakah Anda Yakin?',
                        text: 'User ' + data.name + ' akan dihapus',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Hapus',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.value) {
                            $.ajax({
                                type: 'DELETE',
                                url: '/pengguna/{{ $role }}/' + data.id,
                                dataType: 'json',
                                success: function(data) {
                                    table.ajax.reload(null, false);
                                    Swal.fire({
                                        title: 'Berhasil',
                                        icon: 'success',
                                        showCancelButton: false,
                                        timer: 1500
                                    });
                                },
                                error: function(data) {
                                    console.log(data);
                                }
                            });
                        }
                    });
                });
            }
        });

        $("#formUser").on('submit', function(e) {
            if (isCreate) {
                type = 'POST';
                url = '{{ $role }}';
                msg = 'tambahkan';
            } else {
                type = 'PUT';
                url = '/pengguna/{{ $role }}/' + userId;
                msg = 'ubah';
            }
            
            $.ajax({
                type: type,
                url: url,
                data: {
                    name: $("#formUser input[name=name]").val(),
                    email: $("#formUser input[name=email]").val(),
                    password: $("#formUser input[name=password]").val(),
                    password_confirmation: $("#formUser input[name=password_confirmation]").val(),
                    role: $("#formUser input[name=role]").val()
                },
                dataType: 'json',
                success: function(data) {
                    $("#title").html("Tambah {{ ucwords($role) }}");
                    $('#formUser').trigger("reset");
                    table.ajax.reload(null, false);
                    console.log(data);
                    Swal.fire({
                        title: 'Berhasil',
                        text: '{{ ucwords($role) }} ' + data.user.name + ' berhasil di' + msg,
                        icon: 'success',
                        showCancelButton: false,
                        timer: 1500
                    });
                },
                error: function(data) {
                    var errors = $.parseJSON(data.responseText);
                    
                    var message = '';
                    $.each(errors.messages, function(key, value) {
                        if (message != '') {
                            message += '</br>'
                        }
                        message += value;
                    });

                    Swal.fire({
                        title: 'Gagal',
                        html: message,
                        icon: 'error'
                    });
                }
            });

            e.preventDefault();
        });

        $("#formUser").on("reset", function() {
            $("#btnReset").hide();
            isCreate = true;
            userId = '';
            $("#title").html("Tambah {{ ucwords($role) }}");
            $("#btnSubmit").html("Simpan");
            $("#formPassword").show();
            $("#formUser input[name=password]").prop("required", true);
            $("#formUser input[name=password_confirmation]").prop("required", true);
        })
    });
</script>
@endpush