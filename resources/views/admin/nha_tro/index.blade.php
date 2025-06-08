<div class="container">
    <h2>Danh sách nhà trọ</h2>
    <a href="{{ route('nha_tro.create') }}" class="btn btn-primary mb-3">Thêm nhà trọ</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tên tòa nhà</th>
                <th>Mã</th>
                <th>Địa chỉ</th>
                <th>Số tầng</th>
                <th>Dịch vụ</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($nhaTros as $nhaTro)
            <tr>
                <td>{{ $nhaTro->ten_toa_nha }}</td>
                <td>{{ $nhaTro->ma_toa_nha }}</td>
                <td>{{ $nhaTro->dia_chi }}</td>
                <td>{{ $nhaTro->so_tang }}</td>
                <td>
                    @foreach ($nhaTro->dichVus as $dv)
                        <span class="badge bg-info">{{ $dv->ten_dich_vu }}</span>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('nha_tro.edit', $nhaTro->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                    <form action="{{ route('nha_tro.destroy', $nhaTro->id) }}" method="POST" style="display:inline-block;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Xóa nhà trọ này?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>