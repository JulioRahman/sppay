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
                <form id="formSiswa">
                    @csrf
                    <div class="row card-body">
                        {{-- <div class="col-lg-6">
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="nisn">NISN</label>
                                    <input type="number" class="form-control" id="nisn" name="nisn" placeholder=""
                                        min="1" max="9999999999" maxlength="10" required>
                                </div>

                                <div class="form-group col">
                                    <label for="nis">NIS</label>
                                    <input type="number" class="form-control" id="nis" name="nis" placeholder="" min="1"
                                        max="999999999" maxlength="9" required>
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
                        </div> --}}
                    </div>
                </form>
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
                { data: 'payment_date', name: 'payment_date' },
                { data: 'operator_name', name: 'operator_name' },
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