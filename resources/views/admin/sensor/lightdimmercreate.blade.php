@extends('layout.topbar')
@section('content')
@if (Auth::user()->level == 'Admin' || Auth::user()->level == 'Developer')


<div class="page-content">
    <!-- Page Header-->
    <div class="bg-dash-dark-1 py-4">
        <div class="container-fluid">
            <h2 class="h5 mb-0">Tambah Lampu Dimmer</h2>
        </div>
    </div>
    <div class="container-fluid">
        <section class="pt-3 mt-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{url('daftar-sensor')}}">
                            <button class="btn btn-info">
                                Kembali
                            </button>
                        </a>
                    </div>
                    <div class="card-body pt-0">
                        <form class="form-horizontal" id="formNewUser" name="formNewUser" method="POST"
                            action="{{ route('storeLightDimmerList') }}">
                            {{ csrf_field() }}

                            <div class="form-group mb-3">
                                <label for="name" class="col-dm-6 control-label">Nama</label>
                                <div class="col-center">
                                    <input type="text" id="nama" name="nama" class="form-control">
                                    <input type="hidden" id="nilai" name="nilai" value="0" class="form-control">
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="level" class="col-dm-6 control-label">Status</label>
                                <div class="col-center">
                                    <select id="status" name="status" class="btn btn-outline-secondary dropdown-toggle"
                                        type="button" data-bs-toggle="dropdown" aria-expanded="false"
                                        form="formNewUser">
                                        <option value="0">Off</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <div class="col text-right ">
                                    <button type="submit" class="btn btn-success" name="action">
                                        Tambahkan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


    </div>
</div>
@else
<div class="page-content">
    <!-- Page Header-->
    <div class="bg-dash-dark-1 py-4">
        <div class="container-fluid">
            <h2 class="h5 mb-0">Akses Ditolak</h2>
        </div>
    </div>
    <div class="container-fluid">
        <section class="pt-3 mt-3">
            <div class="container-fluid">
                <div class="row d-flex align-items-stretch gy-4">
                    <div class="col-lg">
                        <!-- Sales bar chart-->
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-end justify-content-between pt-2 pb-2">
                                    <h3 class="h4 mb-3 text-white">Akses Menuju Laman Ditolak</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endif
@stop