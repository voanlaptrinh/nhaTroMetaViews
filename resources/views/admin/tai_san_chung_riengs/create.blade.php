<h1>Thêm mới tài sản chung/riêng</h1>
<form action="{{ route('tai_san_chung_riengs.store') }}" method="POST">
    @csrf

    {{-- Nhà trọ --}}
    <div class="mb-3">
        <label class="form-label">Nhà trọ</label>
        <select name="nha_tro_id" id="nha_tro_id" class="form-control" required>
            <option value="">-- Chọn nhà trọ --</option>
            @foreach($nhaTros as $nhaTro)
                <option value="{{ $nhaTro->id }}">{{ $nhaTro->ten_toa_nha }}</option>
            @endforeach
        </select>
    </div>

    {{-- Phòng trọ --}}
    <div class="mb-3">
        <label class="form-label">Phòng trọ</label>
        <select name="room_id" id="room_id" class="form-control">
            <option value="">-- Chọn phòng --</option>
        </select>
    </div>

    {{-- Tài sản chung --}}
    <hr>
    <h4>Tài sản chung</h4>
    @foreach($taiSans as $ts)
        <div class="form-check">
            <input type="checkbox" name="tai_san_chung_ids[]" value="{{ $ts->id }}" id="tsc{{ $ts->id }}">
            <label for="tsc{{ $ts->id }}">{{ $ts->ten_tai_san }}</label>
        </div>
    @endforeach

    {{-- Tài sản riêng --}}
    <hr>
    <h4>Tài sản riêng</h4>
    @foreach($taiSans as $ts)
        <div class="form-check">
            <input type="checkbox" name="tai_san_rieng_ids[]" value="{{ $ts->id }}" id="tsr{{ $ts->id }}">
            <label for="tsr{{ $ts->id }}">{{ $ts->ten_tai_san }}</label>
        </div>
    @endforeach

    <br>
    <button type="submit" class="btn btn-success">Lưu</button>
    <a href="{{ route('tai_san_chung_riengs.index') }}" class="btn btn-secondary">Hủy</a>
</form>

<script>
    document.getElementById('nha_tro_id').addEventListener('change', function () {
        const nhaTroId = this.value;
        const roomSelect = document.getElementById('room_id');
        roomSelect.innerHTML = '<option value="">-- Chọn phòng --</option>';

        if (nhaTroId) {
            fetch(`/api/ajax/rooms-by-nhatro/${nhaTroId}`)
                .then(res => res.json())
                .then(data => {
                    data.forEach(room => {
                        const option = document.createElement('option');
                        option.value = room.id;
                        option.textContent = room.ma_phong + (room.da_ton_tai ? ' (ĐÃ TỒN TẠI)' : '');
                        if (room.da_ton_tai) {
                            option.disabled = true;
                        }
                        roomSelect.appendChild(option);
                    });
                });
        }
    });
</script>
