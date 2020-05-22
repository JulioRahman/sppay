@extends('layouts.layout')

@section('title', 'Manajemen Siswa')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Siswa</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <a href="#collapseCard" class="d-block card-header py-3 collapsed" data-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="collapseCard" id="collapseCardButton">
                    <h6 class="m-0 font-weight-bold text-primary" id="title">Tambah Siswa</h6>
                </a>
                <div class="collapse" id="collapseCard">
                    <form id="formSiswa">
                        @csrf
                        <div class="row card-body">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="nisn">NISN</label>
                                        <input type="number" class="form-control" id="nisn" name="nisn" placeholder=""
                                            min="1" max="9999999999" maxlength="10" required>
                                    </div>

                                    <div class="form-group col">
                                        <label for="nis">NIS</label>
                                        <input type="number" class="form-control" id="nis" name="nis" placeholder=""
                                            min="1" max="999999999" maxlength="9" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="student_name">Nama</label>
                                    <input type="text" class="form-control" id="student_name" name="student_name"
                                        placeholder="" required>
                                </div>

                                <div class="form-group">
                                    <label for="class">Kelas</label>
                                    <select class="form-control" id="class" name="class">
                                        @foreach ($classes as $class)
                                        <option value="{{ $class->id }}">
                                            {{ $class->grade . " " . $class->majors . " " . $class->class_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="spp">SPP</label>
                                    <select class="form-control" id="spp" name="spp">
                                        @foreach ($spps as $spp)
                                        <option value="{{ $spp->id }}">
                                            {{ $spp->school_year . " - Rp" . number_format($spp->nominal, 0, ",", ".") }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="address">Alamat</label>
                                    <textarea class="form-control" id="address" name="address" placeholder="" rows="3"
                                        disabled></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="telephone_number">Nomor Telepon</label>
                                    <input type="tel" class="form-control" id="telephone_number" name="telephone_number"
                                        placeholder="" disabled>
                                </div>

                                <button id="btnSubmit" type="submit" class="btn btn-primary float-right">Simpan</button>
                                <button id="btnReset" type="reset" class="btn btn-danger float-right mr-2"
                                    style="display: none">Batal</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">

            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">NISN</th>
                                    <th scope="col">NIS</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Kelas</th>
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
        var studentId;
        var type;
        var url;
        var msg;

        var table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: 'siswa/json',
            columns: [
                { data: 'nisn', name: 'nisn' },
                { data: 'nis', name: 'nis' },
                { data: 'student_name', name: 'student_name' },
                { data: 'null', render: function ( data, type, row ) {
                        return row.class.grade + ' ' + row.class.majors + ' ' + row.class.class_name;
                    }
                },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            "columnDefs": [{
                "targets": -1,
                "data": null,
                "defaultContent": "<a href='' class='pr-2' id='viewData' title='Dalam Pengembangan'><i class='fas fa-eye'></i></a>" +
                    "<a href='' class='pr-2' id='editData'><i class='fas fa-edit'></i></a>" +
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
                $('#dataTable tbody').on( 'click', '#viewData', function(e) {
                    e.preventDefault();
                });

                $('#dataTable tbody').on( 'click', '#editData', function(e) {
                    e.preventDefault();
                    toggleCollapseCard(false);

                    var data = table.row( $(this).parents('tr') ).data();
                    $("#formSiswa input[name=nisn]").val(data.nisn).focus();
                    $("#formSiswa input[name=nis]").val(data.nis);
                    $("#formSiswa input[name=student_name]").val(data.student_name);
                    $("#formSiswa select[name=class]").val(data.__class_id);
                    isCreate = false;
                    studentId = data.nisn;
                    $("#title").html("Sunting Siswa");
                    $("#btnSubmit").html("Ubah");
                    $("#btnReset").show();
                });

                $('#dataTable tbody').on( 'click', '#deleteData', function(e) {
                    e.preventDefault();

                    var data = table.row( $(this).parents('tr') ).data();
                    Swal.fire({
                        title: 'Apakah Anda Yakin?',
                        text: 'Siswa ' + data.student_name + ' akan dihapus',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Hapus',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.value) {
                            $.ajax({
                                type: 'DELETE',
                                url: '/siswa/' + data.nisn,
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

        $("#formSiswa").on('submit', function(e) {
            if (isCreate) {
                type = 'POST';
                url = '/siswa';
                msg = 'tambahkan';
            } else {
                type = 'PUT';
                url = '/siswa/' + studentId;
                msg = 'ubah';
            }
            
            $.ajax({
                type: type,
                url: url,
                data: {
                    nisn: $("#formSiswa input[name=nisn]").val(),
                    nis: $("#formSiswa input[name=nis]").val(),
                    student_name: $("#formSiswa input[name=student_name]").val(),
                    __class_id: $("#formSiswa select[name=class]").val(),
                    spp: $("#formSiswa select[name=spp]").val()
                },
                dataType: 'json',
                success: function(data) {
                    $("#title").html("Tambah Siswa");
                    $('#formSiswa').trigger("reset");
                    table.ajax.reload(null, false);
                    Swal.fire({
                        title: 'Berhasil',
                        text: 'Siswa ' + data.student.student_name + ' berhasil di' + msg,
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

        $("#formSiswa").on("reset", function() {
            toggleCollapseCard(true);
            $("#btnReset").hide();
            isCreate = true;
            studentId = '';
            $("#title").html("Tambah Siswa");
            $("#btnSubmit").html("Simpan");
        })

        function toggleCollapseCard(collapse) {
            if ($('#collapseCardButton').attr('aria-expanded') === 'false' && !collapse
                || $('#collapseCardButton').attr('aria-expanded') === 'true' && collapse) {
                $('#collapseCardButton').trigger('click');
            }
        }
    });
</script>
@endpush