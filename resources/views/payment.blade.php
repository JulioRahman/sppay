@extends('layouts.layout')

@section('title', 'Pembayaran')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pembayaran</h1>
    </div>

    <div class="row">

        <div class="col-lg-4">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary" id="title">Pembayaran SPP</h6>
                </div>
                <div class="card-body">
                    <form id="formBayar">
                        @csrf
                        <div class="form-group">
                            <label for="nisn">NISN</label>
                            <input type="text" class="form-control" id="nisn" name="nisn" placeholder=""
                                required>
                        </div>

                        <div class="form-group">
                            <label for="month_paid">Jumlah Bulan Dibayar</label>
                            <input type="number" class="form-control" id="month_paid" name="month_paid" placeholder=""
                                min="1" max="12" required>
                        </div>

                        <button id="btnSubmit" type="submit" class="btn btn-primary float-right">Bayar</button>
                        <button id="btnReset" type="reset" class="btn btn-danger float-right mr-2"
                            style="display: none">Batal</button>
                    </form>
                </div>
            </div>

        </div>

        <div class="col-lg-12">

            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    {{-- <th scope="col">ID</th> --}}
                                    <th scope="col">Siswa</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">SPP</th>
                                    <th scope="col">Bulan Dibayar</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Petugas</th>
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
        var paymentId;
        var type;
        var url;
        var msg;

        var table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: 'bayar/json',
            columns: [
                { data: 'student.student_name', name: 'student.student_name' },
                { data: 'student.class.grade', render: function ( data, type, row ) {
                    return row.student.class.grade + ' ' + row.student.class.majors + ' ' + row.student.class.class_name;
                } },
                { data: 'spp.nominal', render: function ( data, type, row ) {
                    return row.spp.school_year + ' - ' + row.spp.nominal;
                } },
                { data: 'month_paid', render: function(data) {
                    return data + ' bulan';
                } },
                { data: 'payment_date', name: 'payment_date' },
                { data: 'operator.name', name: 'operator.name' },
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
                // $('#dataTable tbody').on( 'click', '#editData', function(e) {
                //     e.preventDefault();

                //     var data = table.row( $(this).parents('tr') ).data();
                //     $("#formBayar select[name=grade]").val(data.grade).focus();
                //     $("#formBayar select[name=class_name]").val(data.class_name);
                //     $("#formBayar select[name=majors]").val(data.majors);
                //     isCreate = false;
                //     paymentId = data.id;
                //     $("#title").html("Sunting Kelas");
                //     $("#btnSubmit").html("Ubah");
                //     $("#btnReset").show();
                // });

                // $('#dataTable tbody').on( 'click', '#deleteData', function(e) {
                //     e.preventDefault();

                //     var data = table.row( $(this).parents('tr') ).data();
                //     Swal.fire({
                //         title: 'Apakah Anda Yakin?',
                //         text: 'Kelas ' + data.grade + ' ' + data.majors + ' ' + data.class_name + ' akan dihapus',
                //         icon: 'question',
                //         showCancelButton: true,
                //         confirmButtonText: 'Hapus',
                //         cancelButtonText: 'Batal'
                //     }).then((result) => {
                //         if (result.value) {
                //             $.ajax({
                //                 type: 'DELETE',
                //                 url: '/kelas/' + data.id,
                //                 dataType: 'json',
                //                 success: function(data) {
                //                     table.ajax.reload(null, false);
                //                     Swal.fire({
                //                         title: 'Berhasil',
                //                         icon: 'success',
                //                         showCancelButton: false,
                //                         timer: 1500
                //                     });
                //                 },
                //                 error: function(data) {
                //                     console.log(data);
                //                 }
                //             });
                //         }
                //     });
                // });
            }
        });

        $("#formBayar").on('submit', function(e) {
            if (isCreate) {
                type = 'POST';
                url = '/bayar';
                msg = 'bayar';
            } else {
                type = 'PUT';
                url = '/bayar/' + paymentId;
                msg = 'ubah';
            }
            
            $.ajax({
                type: type,
                url: url,
                data: {
                    nisn: $("#formBayar input[name=nisn]").val(),
                    month_paid: $("#formBayar input[name=month_paid]").val()
                },
                dataType: 'json',
                success: function(data) {
                    $("#title").html("Pembayaran SPP");
                    $('#formBayar').trigger("reset");
                    table.ajax.reload(null, false);
                    Swal.fire({
                        title: 'Berhasil',
                        text: 'SPP ' + data.student.student_name + ' berhasil di' + msg,
                        icon: 'success',
                        showCancelButton: false,
                        timer: 1500
                    });
                },
                error: function(data) {
                    $("#title").html("Pembayaran SPP");
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

        $("#formBayar").on("reset", function() {
            $("#btnReset").hide();
            isCreate = true;
            paymentId = '';
            $("#title").html("Pembayaran SPP");
            $("#btnSubmit").html("Bayar");
        })
    });
</script>
@endpush