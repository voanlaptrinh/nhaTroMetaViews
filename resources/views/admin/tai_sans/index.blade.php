<div class="container">
    <h2>Danh sách tài sản</h2>
    <a href="{{ route('tai-sans.create') }}" class="btn btn-success mb-3">Thêm tài sản</a>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mã</th>
                <th>Tên</th>
                <th>Ngày mua</th>
                <th>Giá trị</th>
                <th>Tình trạng</th>
                <th>Ghi chú</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($taiSans as $ts)
            <tr>
                <td>{{ $ts->ma_tai_san }}</td>
                <td>{{ $ts->ten_tai_san }}</td>
                <td>{{ $ts->ngay_mua }}</td>
                <td>{{ number_format($ts->gia_tri) }}</td>
                <td>{{ $ts->tinh_trang }}</td>
                <td>{{ $ts->ghi_chu }}</td>
                <td>
                    <a href="{{ route('tai-sans.edit', $ts->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('tai-sans.destroy', $ts->id) }}" method="POST" style="display:inline-block">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Xóa tài sản?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>