@php
    $selectedNhaTroId = old('nha_tro_id', optional($room->nhaTro ?? null)->id ?? '');
    $selectedMaPhong = old('ma_phong', optional($room)->ma_phong ?? '');
@endphp
<div class="row g-2">
    <div class="col-lg-4">
        <div class="">
            <label class="form-label">Tên phòng</label>
            <input type="text" name="ten_phong" class="form-control"
                value="{{ old('ten_phong', optional($room)->ten_phong) }}" required>
        </div>
        @error('ten_phong')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-lg-4">
        <label class="form-label">Chọn tòa nhà</label>
        <select name="nha_tro_id" id="nha_tro_id" class="form-select" required data-selected="{{ $selectedNhaTroId }}">
            <option value="">-- Chọn tòa nhà --</option>
            @foreach ($nhaTros as $nhaTro)
                <option value="{{ $nhaTro->id }}" data-so-tang="{{ $nhaTro->so_tang }}"
                    data-so-phong="{{ $nhaTro->so_phong_tang }}"
                    {{ $selectedNhaTroId == $nhaTro->id ? 'selected' : '' }}>
                    {{ $nhaTro->ten_toa_nha }}
                </option>
            @endforeach
        </select>
        @error('nha_tro_id')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-lg-4">
        <label class="form-label">Chọn mã phòng</label>
        <select name="ma_phong" id="ma_phong" class="form-select" required data-selected="{{ $selectedMaPhong }}">
            <option value="">-- Chọn mã phòng --</option>
        </select>
    </div>

    <div class="col-lg-4">
        <label class="form-label">Diện tích (m²)</label>
        <input type="number" name="dien_tich" class="form-control"
            value="{{ old('dien_tich', optional($room)->dien_tich) }}">
        @error('dien_tich')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-lg-4">
        <label class="form-label">Số khách tối đa</label>
        <input type="number" name="so_khach" class="form-control"
            value="{{ old('so_khach', optional($room)->so_khach) }}">
        @error('so_khach')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>


    <div class="col-lg-4">
        <label class="form-label">Loại phòng</label>
        <select name="loai_phong" class="form-control">
            @php
                $loai_phong = old('loai_phong', optional($room)->loai_phong);
            @endphp
            <option value="van_phong" {{ $loai_phong == 'van_phong' ? 'selected' : '' }}>Văn phòng</option>
            <option value="can_ho" {{ $loai_phong == 'can_ho' ? 'selected' : '' }}>Căn hộ</option>
            <option value="phong_cho_thue" {{ $loai_phong == 'phong_cho_thue' ? 'selected' : '' }}>Phòng cho thuê
            </option>
            <option value="khac" {{ $loai_phong == 'khac' ? 'selected' : '' }}>Khác</option>
        </select>
        @error('loai_phong')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-lg-4">
        <label class="form-label">Giá thuê (VNĐ)</label>
        <input type="number" name="gia_thue" class="form-control"
            value="{{ old('gia_thue', optional($room)->gia_thue ?? 0) }}">
        @error('gia_thue')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-lg-4">
        <label class="form-label">Đã thuê?</label>
        <select name="da_thue" class="form-control">
            <option value="0" {{ old('da_thue', optional($room)->da_thue) == 0 ? 'selected' : '' }}>Chưa thuê
            </option>
            <option value="1" {{ old('da_thue', optional($room)->da_thue) == 1 ? 'selected' : '' }}>Đã thuê
            </option>
        </select>
        @error('da_thue')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-lg-4">
        <label class="form-label">Trạng thái</label>
        <select name="status" class="form-control">
            @php
                $status = old('status', optional($room)->status);
            @endphp
            <option value="trong" {{ $status == 'trong' ? 'selected' : '' }}>Trống</option>
            <option value="dang_sua" {{ $status == 'dang_sua' ? 'selected' : '' }}>Đang sửa</option>
            <option value="da_thue" {{ $status == 'da_thue' ? 'selected' : '' }}>Đã thuê</option>
        </select>
        @error('trang_thai')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label class="form-label">Ảnh phòng</label>

        {{-- Button chọn ảnh --}}
        <div class="mb-2">
            <button type="button" id="addImageBtn" class="btn btn-outline-primary">+ Chọn ảnh</button>
            <input type="file" name="images[]" class="d-none" id="imageInput" accept="image/*" multiple>
        </div>

        {{-- Hiển thị ảnh xem trước --}}
        <div id="imagePreview" class="d-flex flex-wrap gap-2 mb-2"></div>

        {{-- Ảnh đã có sẵn (cũ) --}}
        @if (!empty($room) && $room->images)
            @php
                $images = is_array($room->images) ? $room->images : json_decode($room->images, true);
            @endphp
            <div id="existingImages" class="d-flex flex-wrap gap-2 mb-2">
                @foreach ($images as $img)
                    <div class="position-relative">
                        <img src="{{ asset($img) }}" class="rounded border whx-100">
                        <input type="hidden" name="existing_images[]" value="{{ $img }}">
                        <button type="button"
                            class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-existing-image"
                            title="Xóa">
                            &times;
                        </button>
                    </div>
                @endforeach
            </div>
        @endif

        @error('images')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        <div class="col-lg-12">
            <label class="form-label">Ghi chú</label>
            <textarea name="ghi_chu" class="form-control">{{ old('ghi_chu', optional($room)->ghi_chu) }}</textarea>
            @error('ghi_chu')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>















    </div>
</div>







<script>
    const addImageBtn = document.getElementById('addImageBtn');
    const imageInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');

    addImageBtn.addEventListener('click', () => {
        imageInput.click();
    });

    imageInput.addEventListener('change', () => {
        [...imageInput.files].forEach(file => {
            const reader = new FileReader();
            reader.onload = e => {
                const div = document.createElement('div');
                div.className = 'position-relative';

                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'rounded border whx-100';

                const removeBtn = document.createElement('button');
                removeBtn.className = 'btn btn-sm btn-danger position-absolute top-0 end-0';
                removeBtn.innerHTML = '&times;';
                removeBtn.onclick = () => div.remove();

                div.appendChild(img);
                div.appendChild(removeBtn);
                imagePreview.appendChild(div);
            };
            reader.readAsDataURL(file);
        });
    });

    // Xoá ảnh đã có sẵn (server side)
    document.querySelectorAll('.remove-existing-image').forEach(btn => {
        btn.addEventListener('click', () => {
            btn.closest('div').remove();
        });
    });
</script>





<script>
    document.addEventListener('DOMContentLoaded', function() {
        const nhaTroSelect = document.getElementById('nha_tro_id');
        const maPhongSelect = document.getElementById('ma_phong');

        // Gọi lại logic tạo danh sách phòng khi form sửa được mở
        if (nhaTroSelect.value) {
            generateMaPhongOptions(nhaTroSelect);
        }

        nhaTroSelect.addEventListener('change', function() {
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
