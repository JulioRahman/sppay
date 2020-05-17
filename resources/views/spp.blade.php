@extends('layouts.layout')

@section('title', 'Data SPP')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">SPP</h1>
    </div>

    <div class="row">

        <div class="col-lg-4">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary" id="title">Tambah SPP</h6>
                </div>
                <div class="card-body">
                    <form id="formSpp">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="schoolYear1">Tahun Ajaran</label>
                                <input type="number" class="form-control" id="schoolYear1" name="schoolYear1"
                                    placeholder="" oninput="addSchoolYear()" min="1900" max="3000" maxlength="4"
                                    required>
                            </div>

                            <div class="form-group col-1 text-center my-auto">
                                <label>&nbsp;</label>
                                <p>/</p>
                            </div>

                            <div class="form-group col">
                                <label for="schoolYear2">&nbsp;</label>
                                <input type="number" class="form-control" id="schoolYear2" name="schoolYear2"
                                    placeholder="" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nominal">Nominal</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input id="nominal" type="text" class="form-control" name="nominal" placeholder=""
                                    aria-label="Username" aria-describedby="nominal" min="1" required>
                            </div>
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
                                    <th scope="col">Tahun Ajaran</th>
                                    <th scope="col">Nominal</th>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"
    integrity="sha256-yE5LLp5HSQ/z+hJeCqkz9hdjNkk1jaiGG0tDCraumnA=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.11/dist/sweetalert2.all.min.js"></script>
<script src="{{ asset('js/jquery.number.js') }}"></script>
<script>
    function addSchoolYear() {
        let schoolYear1 = document.getElementById("schoolYear1");
        let schoolYear2 = document.getElementById("schoolYear2");

        if (schoolYear1.value.length > schoolYear1.maxLength) 
            schoolYear1.value = schoolYear1.value.slice(0, schoolYear1.maxLength);
        
        var year = schoolYear1.value;
        schoolYear2.value = parseInt(year) + 1;
    }

    $(document).ready( function () {
        var isCreate = true;
        var sppId;
        var type;
        var url;
        var msg;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#nominal').mask('000.000.000', {reverse: true});

        var table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: 'spp/json',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'school_year', name: 'school_year' },
                { data: 'nominal', name: 'nominal', render: function (data) {
                    return 'Rp' + $.number(data, 0, ',', '.');
                } },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            "columnDefs": [{
                "targets": -1,
                "data": null,
                "defaultContent": "<a href='' class='pr-2' id='editData'><i class='fas fa-edit'></i></a>" + 
                    "<a href='' id='deleteData'><i class='fas fa-trash'></i></a>"
            }],
            "order": [1, 'desc'],
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
                    $("#formSpp input[name=schoolYear1]").val(data.school_year.substr(0, 4)).focus();
                    addSchoolYear();
                    $("#formSpp input[name=nominal]").val(data.nominal).trigger("input");
                    isCreate = false;
                    sppId = data.id;
                    $("#title").html("Sunting SPP");
                    $("#btnSubmit").html("Ubah");
                    $("#btnReset").show();
                });

                $('#dataTable tbody').on( 'click', '#deleteData', function(e) {
                    e.preventDefault();

                    var data = table.row( $(this).parents('tr') ).data();
                    Swal.fire({
                        title: 'Apakah Anda Yakin?',
                        text: 'SPP tahun ajaran ' + data.school_year + ' akan dihapus',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Hapus',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.value) {
                            $.ajax({
                                type: 'DELETE',
                                url: '/spp/' + data.id,
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

        $("#formSpp").on('submit', function(e) {
            if (isCreate) {
                type = 'POST';
                url = '/spp';
                msg = 'tambahkan';
            } else {
                type = 'PUT';
                url = '/spp/' + sppId;
                msg = 'ubah';
            }
            
            $.ajax({
                type: type,
                url: url,
                data: {
                    school_year: $("#formSpp input[name=schoolYear1]").val() 
                        + '/' + $("#formSpp input[name=schoolYear2]").val(),
                    nominal: $("#formSpp input[name=nominal]").cleanVal()
                },
                dataType: 'json',
                success: function(data) {
                    $("#title").html("Tambah SPP");
                    $('#formSpp').trigger("reset");
                    table.ajax.reload(null, false);
                    Swal.fire({
                        title: 'Berhasil',
                        text: 'SPP tahun ajaran ' + data.spp.school_year + ' berhasil di' + msg,
                        icon: 'success',
                        showCancelButton: false,
                        timer: 1500
                    });
                },
                error: function(data) {
                    $("#title").html("Tambah SPP");
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

        $("#formSpp").on("reset", function() {
            $("#btnReset").hide();
            isCreate = true;
            sppId = '';
            $("#title").html("Tambah SPP");
            $("#btnSubmit").html("Simpan");
        })
    });
</script>
@endpush