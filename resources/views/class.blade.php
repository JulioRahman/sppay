@extends('layouts.layout')

@section('title', 'Kelas')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kelas</h1>
    </div>

    <div class="row">

        <div class="col-lg-4">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Kelas</h6>
                </div>
                <div class="card-body">
                    <form id="formKelas">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="grade">Tingkat</label>
                                <select class="form-control" id="grade" name="grade">
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                </select>
                            </div>

                            <div class="form-group col">
                                <label for="name">Nama</label>
                                <select class="form-control" id="name" name="name">
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="majors">Kompetensi Keahlian</label>
                            <select class="form-control" id="majors" name="majors">
                                <option value="TEI">TEI</option>
                                <option value="TEDK">TEDK</option>
                                <option value="TOI">TOI</option>
                                <option value="TPTU">TPTU</option>
                                <option value="IOP">IOP</option>
                                <option value="MEKA">MEKA</option>
                                <option value="SIJA">SIJA</option>
                                <option value="RPL">RPL</option>
                                <option value="PFPT">PFPT</option>
                            </select>
                        </div>

                        <button id="btnSubmit" type="submit" class="btn btn-primary float-right">Simpan</button>
                        <button id="btnReset" type="reset" class="btn btn-danger float-right mr-2"
                            style="display: none">Batal</button>
                    </form>
                </div>
            </div>

        </div>

        <div class="col-lg-8">

            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Tingkat</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Kompetensi Keahlian</th>
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
        var classId;
        var type;
        var url;
        var msg;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: 'kelas/json',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'grade', name: 'grade' },
                { data: 'name', name: 'name' },
                { data: 'majors', name: 'majors' },
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
                    console.log(data);
                    $("#formKelas select[name=grade]").val(data.grade);
                    $("#formKelas select[name=name]").val(data.name);
                    $("#formKelas select[name=majors]").val(data.majors);
                    $("#formKelas select[name=grade]").focus();
                    isCreate = false;
                    classId = data.id;
                    $("#btnSubmit").html("Ubah");
                    $("#btnReset").show();
                });

                $('#dataTable tbody').on( 'click', '#deleteData', function(e) {
                    e.preventDefault();

                    var data = table.row( $(this).parents('tr') ).data();
                    Swal.fire({
                        title: 'Apakah Anda Yakin?',
                        text: 'Kelas ' + data.grade + ' ' + data.majors + ' ' + data.name + ' akan dihapus',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Hapus',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.value) {
                            $.ajax({
                                type: 'DELETE',
                                url: '/kelas/' + data.id,
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

        $("#formKelas").on('submit', function(e) {
            if (isCreate) {
                type = 'POST';
                url = '/kelas';
                msg = 'tambahkan';
            } else {
                type = 'PUT';
                url = '/kelas/' + classId;
                msg = 'ubah';
            }
            
            $.ajax({
                type: type,
                url: url,
                data: {
                    grade: $("#formKelas select[name=grade]").val(),
                    name: $("#formKelas select[name=name]").val(),
                    majors: $("#formKelas select[name=majors]").val()
                },
                dataType: 'json',
                success: function(data) {
                    $('#formKelas').trigger("reset");
                    table.ajax.reload(null, false);
                    Swal.fire({
                        title: 'Berhasil',
                        text: 'Kelas ' + data.class.grade + ' ' + data.class.majors + ' ' + data.class.name + ' berhasil di' + msg,
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

        $("#formKelas").on("reset", function() {
            $("#btnReset").hide();
            isCreate = true;
            classId = '';
            $("#btnSubmit").html("Simpan");
        })
    });
</script>
@endpush