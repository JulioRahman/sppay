@extends('layouts.layout')

@section('title')
SPP
@endsection

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">SPP</h1>
    </div>

    <div class="row">

        <div class="col-lg-6">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah SPP</h6>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="schoolYear1">Tahun Ajaran</label>
                            <input type="number" class="form-control" id="schoolYear1" placeholder="{{ date('Y') }}">
                        </div>
                        
                        <div class="form-group col-1 text-center my-auto">
                            <label>&nbsp;</label>
                            <p>/</p>
                        </div>

                        <div class="form-group col">
                            <label for="schoolYear2">&nbsp;</label>
                            <input type="number" class="form-control" id="schoolYear2" placeholder="{{ date('Y')+1 }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nominal">Nominal</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="nominal">Rp</span>
                            </div>
                            <input type="number" class="form-control" placeholder="2400000" aria-label="Username" aria-describedby="nominal" min="0.00">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary float-right">Simpan</button>
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
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Row 1 Data 2</td>
                                    <td>Row 1 Data 3</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Row 2 Data 2</td>
                                    <td>Row 2 Data 3</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Row 3 Data 2</td>
                                    <td>Row 3 Data 3</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

      </div>
</div>
<!-- /.container-fluid -->
@endsection