@extends('layout.topbar')
@section('content')
@if (Auth::user()->level == 'Admin' || Auth::user()->level == 'Developer')


<div class="page-content">
    <!-- Page Header-->
    <div class="bg-dash-dark-1 py-4">
        <div class="container-fluid">
            <h2 class="h5 mb-0">Edit Panel</h2>
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

                        @foreach($editpanel as $editpanels)
                        <form class="form-horizontal" id="formEditUser" name="formEditUser" method="POST"
                            action="{{ route('updatePanelList') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{$editpanels->id}}">
                            <div class="form-group mb-3">
                                <label for="name-edit" class="col-dm-6 control-label">Nama</label>
                                <div class="col-center">
                                    <input type="text" id="nama-edit" name="nama-edit" value="{{$editpanels->nama}}"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <div class="col text-right">
                                    <button type="submit" class="btn btn-primary" name="action">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>
                        @endforeach
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