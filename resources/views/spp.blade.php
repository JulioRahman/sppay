@extends('layouts.layout')

@section('title', 'SPP')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">SPP</h1>
    </div>

    @if(session('msg') != null) 
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <strong>{{ session('msg') }}</strong> Data SPP telah tersimpan
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="row">

        <div class="col-lg-6">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah SPP</h6>
                </div>
                <div class="card-body">
                    <form action="/spp" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="schoolYear1">Tahun Ajaran</label>
                                <input type="number" class="form-control" id="schoolYear1" name="schoolYear1" placeholder="{{ date('Y') }}" oninput="addSchoolYear()" min="1900" max="3000" maxlength="4" required>
                            </div>
                            
                            <div class="form-group col-1 text-center my-auto">
                                <label>&nbsp;</label>
                                <p>/</p>
                            </div>

                            <div class="form-group col">
                                <label for="schoolYear2">&nbsp;</label>
                                <input type="number" class="form-control" id="schoolYear2" name="schoolYear2" placeholder="{{ date('Y')+1 }}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nominal">Nominal</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="nominal">Rp</span>
                                </div>
                                <input type="number" class="form-control" name="nominal" placeholder="2400000" aria-label="Username" aria-describedby="nominal" min="0.00" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary float-right">Simpan</button>
                    </form>
                </div>
            </div>

        </div>
        
        <div class="col-lg-6">

            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Tahun Ajaran</th>
                                    <th scope="col">Nominal</th>
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
    function addSchoolYear() {
        let schoolYear1 = document.getElementById("schoolYear1");
        let schoolYear2 = document.getElementById("schoolYear2");

        if (schoolYear1.value.length > schoolYear1.maxLength) 
            schoolYear1.value = schoolYear1.value.slice(0, schoolYear1.maxLength);
        
        var year = schoolYear1.value;
        schoolYear2.value = parseInt(year) + 1;
    }

    $(document).ready( function () {
        $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: 'spp/json',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'school_year', name: 'school_year' },
                { data: 'nominal', name: 'nominal' }
            ]
        });
    } );
</script>
@endpush
