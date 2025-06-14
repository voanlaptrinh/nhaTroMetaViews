@extends('admin.index')
@section('contentadmin')
    <div class="pagetitle">
        <h1>Slider</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item active">Thêm Slider</li>
            </ol>
        </nav>
    </div>


    <div class="row">

        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <div class="col-12 d-sm-flex justify-content-between align-items-center">
                        <h5 class="card-title">Thêm mới Slider</h5>

                    </div>
                    @include('admin.slider.form')
                </div>
            </div>
        </div>
    </div>
@endsection
