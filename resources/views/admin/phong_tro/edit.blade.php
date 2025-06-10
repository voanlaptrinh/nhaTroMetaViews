@extends('admin.index')
@section('contentadmin')
    <div class="pagetitle">
        <h1>Phòng trọ</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item active">Sửa Phòng trọ</li>
            </ol>
        </nav>
    </div>


    <div class="row">

        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <div class="col-12 d-sm-flex justify-content-between align-items-center">
                        <h5 class="card-title">Sửa mới Phòng trọ</h5>

                    </div>
                    <form action="{{ route('rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @include('admin.phong_tro.form', ['room' => $room])
                        <div class="text-end pt-4">
                            <button type="submit" class="btn btn-primary">Cập nhật phòng</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
