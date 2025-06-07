<form action="{{ route('dichvus.update', $dichvu->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label for="ten_dich_vu">Tên dịch vụ</label><br>
        <input type="text" id="ten_dich_vu" name="ten_dich_vu" value="{{ old('ten_dich_vu', $dichvu->ten_dich_vu) }}">
        @error('ten_dich_vu')
            <div style="color:red">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="ma_dich_vu">Mã dịch vụ</label><br>
        <input type="text" id="ma_dich_vu" name="ma_dich_vu" value="{{ old('ma_dich_vu', $dichvu->ma_dich_vu) }}">
        @error('ma_dich_vu')
            <div style="color:red">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="don_vi_tinh_id">Đơn vị tính</label><br>
        <select id="don_vi_tinh_id" name="don_vi_tinh_id">
            <option value="">-- Chọn đơn vị tính --</option>
            @foreach($donViTinhs as $dvt)
                <option value="{{ $dvt->id }}" {{ (old('don_vi_tinh_id', $dichvu->don_vi_tinh_id) == $dvt->id) ? 'selected' : '' }}>
                    {{ $dvt->ma_don_vi }} - {{ $dvt->ten_day_du }}
                </option>
            @endforeach
        </select>
        @error('don_vi_tinh_id')
            <div style="color:red">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="don_gia">Đơn giá</label><br>
        <input type="number" id="don_gia" name="don_gia" step="0.01" value="{{ old('don_gia', $dichvu->don_gia) }}">
        @error('don_gia')
            <div style="color:red">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="mo_ta">Mô tả</label><br>
        <textarea id="mo_ta" name="mo_ta">{{ old('mo_ta', $dichvu->mo_ta) }}</textarea>
        @error('mo_ta')
            <div style="color:red">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit">Cập nhật dịch vụ</button>
</form>