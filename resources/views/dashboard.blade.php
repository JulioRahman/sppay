@extends('layouts.layout')

@section('title', 'Dasbor')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dasbor</h1>
    </div>

    @if(!Auth::user()->isStudent())
        <div class="row">

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Siswa</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $student_count }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Kelas</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $class_count }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Petugas</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $operator_count }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-cog fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Uang SPP</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ 'Rp' . number_format($payment_sum, 0, ",", ".") }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @else
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
    @endif

</div>
<!-- /.container-fluid -->
@endsection

@if(Auth::user()->isStudent())
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
@endif
