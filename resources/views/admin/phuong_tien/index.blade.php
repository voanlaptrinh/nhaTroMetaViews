@extends('admin.index')
@section('contentadmin')
    <div class="pagetitle">
        <h1>Nhà trọ</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item active">Nhà trọ</li>
            </ol>
        </nav>
    </div>




    <div class="row">

        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <a href="{{ route('admin.phuong_tiens.create', ['user_id' => request('user_id')]) }}"
                        class="btn btn-success mb-3">
                        Thêm phương tiện
                    </a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tên xe</th>
                                <th>Biển số</th>
                                <th>Loại</th>
                                <th>Chủ xe</th>
                                <th>Khách hàng</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($phuongTiens as $pt)
                                <tr>
                                    <td>{{ $pt->name }}</td>
                                    <td>{{ $pt->bien_so }}</td>
                                    <td>{{ ucfirst(str_replace('_', ' ', $pt->loai_phuong_tien)) }}</td>
                                    <td>{{ $pt->ten_chu_xe }}</td>
                                    <td>{{ $pt->user->name ?? 'Chưa gán' }}</td>
                                    <td>
                                        <a href="{{ route('admin.phuong_tiens.edit', $pt->id) }}"
                                            class="btn btn-warning btn-sm">Sửa</a>
                                        <form action="{{ route('admin.phuong_tiens.destroy', $pt->id) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf @method('DELETE')
                                            <button onclick="return confirm('Xoá phương tiện này?')"
                                                class="btn btn-danger btn-sm">Xoá</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
