<a href="{{ route('dichvus.create') }}" style="margin-bottom: 20px; display: inline-block;">Thêm Dịch Vụ Mới</a>

<table>
    <thead>
        <th>Tên dịch vụ</th>
        <th>Mã dịch vụ</th>
        <th>Đơn vị tính</th>
        <th>Đơn giá</th>
    </thead>
    <tbody>
        <tr>
            @foreach ($dichVus as $dichvu)
                <td>{{ $dichvu->ten_dich_vu }}</td>
                <td>{{ $dichvu->ma_dich_vu }}</td>
                <td>{{ $dichvu->donViTinh ? $dichvu->donViTinh->ma_don_vi . ' - ' . $dichvu->donViTinh->ten_day_du : '-' }}
                </td>
                <td>{{ $dichvu->don_gia }}</td>
                <td>
                    <a href="{{ route('dichvus.edit', $dichvu->id) }}">Sửa</a> |
                    <form action="{{ route('dichvus.destroy', $dichvu->id) }}" method="POST" style="display:inline-block"
                        onsubmit="return confirm('Bạn có chắc muốn xóa dịch vụ này?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            style="background:none;border:none;color:red;cursor:pointer;padding:0;">Xóa</button>
                    </form>
                </td>
            @endforeach
        </tr>
    </tbody>
</table>
