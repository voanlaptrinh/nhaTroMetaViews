

<div class="mb-3">
    <label>Tên phòng</label>
    <input type="text" name="ten_phong" class="form-control" value="{{ old('ten_phong', optional($room)->ten_phong) }}" required>
</div>
@php
    $selectedNhaTroId = old('nha_tro_id', optional($room->nhaTro ?? null)->id ?? '');
    $selectedMaPhong = old('ma_phong', optional($room)->ma_phong ?? '');
@endphp

<select name="nha_tro_id" id="nha_tro_id" class="form-control" required
        data-selected="{{ $selectedNhaTroId }}">
    <option value="">-- Chọn tòa nhà --</option>
    @foreach ($nhaTros as $nhaTro)
        <option 
            value="{{ $nhaTro->id }}"
            data-so-tang="{{ $nhaTro->so_tang }}"
            data-so-phong="{{ $nhaTro->so_phong_tang }}"
            {{ $selectedNhaTroId == $nhaTro->id ? 'selected' : '' }}>
            {{ $nhaTro->ten_toa_nha }}
        </option>
    @endforeach
</select>

<select name="ma_phong" id="ma_phong" class="form-control" required data-selected="{{ $selectedMaPhong }}">
    <option value="">-- Chọn mã phòng --</option>
</select>


     
<div class="row mb-3">
    <div class="col">
        <label>Diện tích (m²)</label>
        <input type="number" name="dien_tich" class="form-control" value="{{ old('dien_tich', optional($room)->dien_tich) }}">
    </div>
    <div class="col">
        <label>Số khách tối đa</label>
        <input type="number" name="so_khach" class="form-control" value="{{ old('so_khach', optional($room)->so_khach) }}">
    </div>
</div>

<div class="mb-3">
    <label>Loại phòng</label>
    <select name="loai_phong" class="form-control">
        @php
            $loai_phong = old('loai_phong', optional($room)->loai_phong);
        @endphp
        <option value="van_phong" {{ $loai_phong == 'van_phong' ? 'selected' : '' }}>Văn phòng</option>
        <option value="can_ho" {{ $loai_phong == 'can_ho' ? 'selected' : '' }}>Căn hộ</option>
        <option value="phong_cho_thue" {{ $loai_phong == 'phong_cho_thue' ? 'selected' : '' }}>Phòng cho thuê</option>
        <option value="khac" {{ $loai_phong == 'khac' ? 'selected' : '' }}>Khác</option>
    </select>
</div>

<div class="mb-3">
    <label>Giá thuê (VNĐ)</label>
    <input type="number" name="gia_thue" class="form-control" value="{{ old('gia_thue', optional($room)->gia_thue ?? 0) }}">
</div>

<div class="mb-3">
    <label>Đã thuê?</label>
    <select name="da_thue" class="form-control">
        <option value="0" {{ old('da_thue', optional($room)->da_thue) == 0 ? 'selected' : '' }}>Chưa thuê</option>
        <option value="1" {{ old('da_thue', optional($room)->da_thue) == 1 ? 'selected' : '' }}>Đã thuê</option>
    </select>
</div>

<div class="mb-3">
    <label>Ảnh phòng (có thể chọn nhiều)</label>
    <input type="file" name="images[]" class="form-control" multiple>
  @if (!empty($room) && $room->images)
    <div class="mt-2">
        @php
            $images = is_array($room->images) ? $room->images : json_decode($room->images, true);
        @endphp
        @foreach ($images as $img)
            <img src="{{ asset( $img) }}" alt="" width="100" class="me-2 mb-2 rounded border">
        @endforeach
    </div>
@endif

</div>

<div class="mb-3">
    <label>Ghi chú</label>
    <textarea name="ghi_chu" class="form-control">{{ old('ghi_chu', optional($room)->ghi_chu) }}</textarea>
</div>

<div class="mb-3">
    <label>Trạng thái</label>
    <select name="status" class="form-control">
        @php
            $status = old('status', optional($room)->status);
        @endphp
        <option value="trong" {{ $status == 'trong' ? 'selected' : '' }}>Trống</option>
        <option value="dang_sua" {{ $status == 'dang_sua' ? 'selected' : '' }}>Đang sửa</option>
        <option value="da_thue" {{ $status == 'da_thue' ? 'selected' : '' }}>Đã thuê</option>
    </select>
</div>

{{-- Hiển thị lỗi --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Có lỗi xảy ra:</strong>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<script>
document.addEventListener('DOMContentLoaded', function () {
    const nhaTroSelect = document.getElementById('nha_tro_id');
    const maPhongSelect = document.getElementById('ma_phong');

    // Gọi lại logic tạo danh sách phòng khi form sửa được mở
    if (nhaTroSelect.value) {
        generateMaPhongOptions(nhaTroSelect);
    }

    nhaTroSelect.addEventListener('change', function () {
        generateMaPhongOptions(this);
    });

    function generateMaPhongOptions(select) {
        const nhaTroId = select.value;
        const soTang = select.options[select.selectedIndex].getAttribute('data-so-tang');
        const soPhong = select.options[select.selectedIndex].getAttribute('data-so-phong');
        const selectedMaPhong = maPhongSelect.getAttribute('data-selected');

        maPhongSelect.innerHTML = '<option value="">-- Chọn mã phòng --</option>';

        if (!nhaTroId || !soTang || !soPhong) return;

        fetch(`/api/get-used-room-codes/${nhaTroId}`)
            .then(response => response.json())
            .then(usedCodes => {
                for (let tang = 1; tang <= soTang; tang++) {
                    for (let phong = 1; phong <= soPhong; phong++) {
                        const maPhong = `${tang}${String(phong).padStart(2, '0')}`;
                        const option = document.createElement('option');
                        option.value = maPhong;
                        option.textContent = `Phòng ${maPhong}`;

                        if (usedCodes.includes(maPhong)) {
                            option.disabled = true;
                            option.textContent += ' (đã tồn tại)';
                        }

                        if (maPhong === selectedMaPhong) {
                            option.selected = true;
                        }

                        maPhongSelect.appendChild(option);
                    }
                }
            });
    }
});
</script>


