@extends('layouts.layout')

@section('title', 'Lihat Siswa')

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
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary" id="title">Lihat Siswa</h6>
                </div>
                <div class="row card-body">
                    <div class="col-lg-6">
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="nisn">NISN</label>
                                <input id="nisn" class="form-control" placeholder="{{$student->nisn}}" disabled>
                            </div>

                            <div class="form-group col">
                                <label for="nis">NIS</label>
                                <input id="nis" class="form-control" placeholder="{{$student->nis}}" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="student_name">Nama</label>
                            <input id="student_name" class="form-control" placeholder="{{$student->student_name}}"
                                disabled>
                        </div>

                        <div class="form-group">
                            <label for="class">Kelas</label>
                            <input id="class" class="form-control" placeholder="{{$student->class->name}}" disabled>
                        </div>

                        <div class="form-group">
                            <label for="spp">SPP</label>
                            <input id="spp" class="form-control"
                                placeholder="{{$student->spp->school_year . " - " . $student->spp->nominal}}" disabled>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <textarea id="address" class="form-control" placeholder="{{$student->address}}" rows="3"
                                disabled></textarea>
                        </div>

                        <div class="form-group">
                            <label for="telephone_number">Nomor Telepon</label>
                            <input id="telephone_number" class="form-control"
                                placeholder="{{$student->telephone_number}}" disabled>
                        </div>
                    </div>
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
                                    <th scope="col">Bulan</th>
                                    <th scope="col">Tahun Ajaran</th>
                                    <th scope="col">Jumlah Bayar</th>
                                    <th scope="col">Tanggal Dibayar</th>
                                    <th scope="col">Petugas</th>
                                    <th scope="col">Keterangan</th>
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
        var table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: 'json/{{ $id }}',
            pageLength: 12,
            bLengthChange: false,
            columns: [
                { data: 'month', name: 'month', orderable: false },
                { data: 'school_year', name: 'school_year' },
                { data: 'nominal_month', name: 'nominal_month', render: function (data) {
                    return 'Rp' + $.number(data, 0, ',', '.');
                } },
                { data: 'payment_date', name: 'payment_date', render: function(data) {
                    if (data != '') {
                        return new Date(data).toLocaleDateString();
                    } else {
                        return '-';
                    }
                } },
                { data: 'operator_name', name: 'operator_name', render: function(data) {
                    if (data != '') {
                        return data;
                    } else {
                        return '-';
                    }
                } },
                { data: 'info', name: 'info', render: function (data) {
                    if (data == '1') {
                        return '<span class="badge badge-success">Lunas</span>';
                    } else if (data == '2') {
                        return '<span class="badge badge-danger">Belum Lunas</span>';
                    }
                } },
            ],
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
            }
        });
    });
</script>
@endpush