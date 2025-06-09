<h1>Danh sách quản lý tài sản chung riêng</h1>

<a href="{{ route('tai_san_chung_riengs.create') }}" class="btn btn-primary mb-3">Thêm mới</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nhà trọ</th>
            <th>Phòng trọ</th>
            <th>Tài sản chung</th>
            <th>Tài sản riêng</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
    @foreach($list as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->nhaTro->ten_toa_nha ?? 'Không rõ' }}</td>
            <td>{{ $item->room->ten_phong ?? 'Không có' }} ({{ $item->room->ma_phong ?? 'Không có' }})</td>
            <td>
                @foreach($item->taiSanChungs as $tsc)
                    {{ $tsc->taiSan->ten_tai_san }}<br>
                @endforeach
            </td>
            <td>
                @foreach($item->taiSanRiengs as $tsr)
                    {{ $tsr->taiSan->ten_tai_san }}<br>
                @endforeach
            </td>
            <td>
                <a href="{{ route('tai_san_chung_riengs.edit', $item->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                <form action="{{ route('tai_san_chung_riengs.destroy', $item->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Bạn có chắc muốn xóa?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" type="submit">Xóa</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>