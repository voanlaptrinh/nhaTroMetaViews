<h1>Sửa quản lý tài sản chung riêng</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Đã có lỗi xảy ra:</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('tai_san_chung_riengs.update', $taiSanChungRieng->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="nha_tro_id" class="form-label">Nhà trọ</label>
        <select name="nha_tro_id" id="nha_tro_id" class="form-control" required>
            <option value="">Chọn nhà trọ</option>
            @foreach ($nhaTros as $nhaTro)
                <option value="{{ $nhaTro->id }}"
                    {{ (old('nha_tro_id') ?? $taiSanChungRieng->nha_tro_id) == $nhaTro->id ? 'selected' : '' }}>
                    {{ $nhaTro->ten_toa_nha }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="room_id" class="form-label">Phòng trọ (Có thể để trống)</label>
        <select name="room_id" id="room_id" class="form-control">
            <option value="">Không chọn phòng</option>
            {{-- Các option sẽ được load JS --}}
        </select>
    </div>

    <hr>
    <h4>Chọn tài sản chung</h4>
    <div class="mb-3">
        @foreach ($taiSans as $taiSan)
            <div class="form-check">
                <input type="checkbox" name="tai_san_chung_ids[]" value="{{ $taiSan->id }}"
                    id="tsc{{ $taiSan->id }}"
                    {{ (is_array(old('tai_san_chung_ids')) ? in_array($taiSan->id, old('tai_san_chung_ids')) : $taiSanChungRieng->taiSanChungs->pluck('tai_san_id')->contains($taiSan->id)) ? 'checked' : '' }}>
                <label for="tsc{{ $taiSan->id }}">{{ $taiSan->ten_tai_san }}</label>
            </div>
        @endforeach
    </div>

    <hr>
    <h4>Chọn tài sản riêng</h4>
    <div class="mb-3">
        @foreach ($taiSans as $taiSan)
            <div class="form-check">
                <input type="checkbox" name="tai_san_rieng_ids[]" value="{{ $taiSan->id }}"
                    id="tsr{{ $taiSan->id }}"
                    {{ (is_array(old('tai_san_rieng_ids')) ? in_array($taiSan->id, old('tai_san_rieng_ids')) : $taiSanChungRieng->taiSanRiengs->pluck('tai_san_id')->contains($taiSan->id)) ? 'checked' : '' }}>
                <label for="tsr{{ $taiSan->id }}">{{ $taiSan->ten_tai_san }}</label>
            </div>
        @endforeach
    </div>

    <button type="submit" class="btn btn-primary">Cập nhật</button>
    <a href="{{ route('tai_san_chung_riengs.index') }}" class="btn btn-secondary">Hủy</a>
</form>

<script>
    const nhaTroSelect = document.getElementById('nha_tro_id');
    const roomSelect = document.getElementById('room_id');
    const oldRoomId = "{{ old('room_id', $taiSanChungRieng->room_id) }}";

    function loadRooms(nhaTroId, selectedRoomId = null) {
        roomSelect.innerHTML = '<option value="">Không chọn phòng</option>';

        if (!nhaTroId) return;

        fetch(`/api/ajax/rooms-by-nhatro/${nhaTroId}`)
            .then(res => res.json())
            .then(data => {
                data.forEach(room => {
                    const option = document.createElement('option');
                    option.value = room.id;
                    option.textContent = room.ma_phong + (room.da_ton_tai ? ' (Đã tồn tại)' : '');
                    if (room.da_ton_tai) {
                        option.disabled = true; // disable option nếu đã tồn tại
                    }
                    if (selectedRoomId && selectedRoomId == room.id) {
                        option.selected = true;
                        if (room.da_ton_tai) {
                            option.disabled = false; // cho phép chọn lại phòng đang dùng trong edit
                        }
                    }
                    roomSelect.appendChild(option);
                });
            });

    }

    // Load phòng khi trang load lần đầu với nhà trọ đang chọn
    document.addEventListener('DOMContentLoaded', function() {
        loadRooms(nhaTroSelect.value, oldRoomId);
    });

    // Load phòng khi thay đổi nhà trọ
    nhaTroSelect.addEventListener('change', function() {
        loadRooms(this.value);
    });
</script>
