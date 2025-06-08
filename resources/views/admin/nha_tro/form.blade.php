@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Đã có lỗi xảy ra:</strong>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="mb-3">
    <label>Tên tòa nhà</label>
    <input type="text" name="ten_toa_nha" value="{{ old('ten_toa_nha', optional($nhaTro)->ten_toa_nha) }}" class="form-control" required>
    @error('ten_toa_nha')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label>Mã tòa nhà</label>
    <input type="text" name="ma_toa_nha" value="{{ old('ma_toa_nha', optional($nhaTro)->ma_toa_nha) }}" class="form-control">
    @error('ma_toa_nha')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label>Địa chỉ</label>
    <input type="text" name="dia_chi" value="{{ old('dia_chi', optional($nhaTro)->dia_chi) }}" class="form-control">
    @error('dia_chi')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="row mb-3">
    <div class="col">
        <label>Phường</label>
        <input type="text" name="phuong" value="{{ old('phuong', optional($nhaTro)->phuong) }}" class="form-control">
        @error('phuong')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col">
        <label>Quận</label>
        <input type="text" name="quan" value="{{ old('quan', optional($nhaTro)->quan) }}" class="form-control">
        @error('quan')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col">
        <label>Thành phố</label>
        <input type="text" name="thanh_pho" value="{{ old('thanh_pho', optional($nhaTro)->thanh_pho) }}" class="form-control">
        @error('thanh_pho')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <div class="col">
        <label>Số tầng</label>
        <input type="number" name="so_tang" value="{{ old('so_tang', optional($nhaTro)->so_tang) }}" class="form-control">
        @error('so_tang')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col">
        <label>Số Phòng/ tầng</label>
        <input type="number" name="so_phong_tang" value="{{ old('so_phong_tang', optional($nhaTro)->so_phong_tang) }}" class="form-control">
        @error('so_phong_tang')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col">
        <label>Diện tích (m2)</label>
        <input type="number" name="dien_tich" value="{{ old('dien_tich', optional($nhaTro)->dien_tich) }}" class="form-control">
        @error('dien_tich')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col">
        <label>Chủ sở hữu</label>
        <input type="text" name="chu_so_huu" value="{{ old('chu_so_huu', optional($nhaTro)->chu_so_huu) }}" class="form-control">
        @error('chu_so_huu')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="mb-3">
    <label>Mô tả</label>
    <textarea name="mo_ta" class="form-control">{{ old('mo_ta', optional($nhaTro)->mo_ta) }}</textarea>
    @error('mo_ta')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label>Trạng thái</label>
    <select name="status" class="form-control">
        <option value="Hoạt động" {{ old('status', optional($nhaTro)->status) == 'Hoạt động' ? 'selected' : '' }}>Hoạt động</option>
        <option value="Ngưng hoạt động" {{ old('status', optional($nhaTro)->status) == 'Ngưng hoạt động' ? 'selected' : '' }}>Ngưng hoạt động</option>
    </select>
    @error('status')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label>Quốc gia</label>
    <input type="text" name="quoc_gia" value="{{ old('quoc_gia', optional($nhaTro)->quoc_gia ?? 'Việt Nam') }}" class="form-control">
    @error('quoc_gia')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label>Dịch vụ áp dụng:</label><br>
    @foreach ($dichVus as $dv)
        <label class="me-3">
            <input type="checkbox" name="dich_vu_ids[]" value="{{ $dv->id }}"
                {{ (optional($nhaTro)->dichVus ?? collect())->contains($dv->id) || (is_array(old('dich_vu_ids')) && in_array($dv->id, old('dich_vu_ids', []))) ? 'checked' : '' }}>
            {{ $dv->ten_dich_vu }}
        </label>
    @endforeach
    @error('dich_vu_ids')
        <div class="text-danger d-block mt-2">{{ $message }}</div>
    @enderror
</div>
