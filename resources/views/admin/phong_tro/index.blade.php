<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Danh sách phòng trọ</h4>
        <a href="{{ route('rooms.create') }}" class="btn btn-primary">+ Thêm phòng mới</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Tòa nhà</th>
                <th>Tên phòng</th>
                <th>Mã phòng</th>
                <th>Diện tích (m²)</th>
                <th>Giá thuê</th>
                <th>Loại phòng</th>
                <th>Trạng thái</th>
                <th>Đã thuê</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($rooms as $room)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $room->nhaTro->ten_toa_nha ?? 'N/A' }}</td>
                    <td>{{ $room->ten_phong }}</td>
                    <td>{{ $room->ma_phong }}</td>
                    <td>{{ $room->dien_tich }} m²</td>
                    <td>{{ number_format($room->gia_thue) }} VNĐ</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $room->loai_phong)) }}</td>
                    <td>
                        <span class="badge bg-{{ $room->status == 'trong' ? 'success' : 'secondary' }}">
                            {{ ucfirst($room->status) }}
                        </span>
                    </td>
                    <td>{{ $room->da_thue ? 'Có' : 'Không' }}</td>
                    <td>
                        <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-sm btn-warning">Sửa</a>

                        <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" style="display:inline-block"
                              onsubmit="return confirm('Bạn có chắc muốn xoá phòng này không?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Xoá</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="11" class="text-center">Không có phòng nào.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>