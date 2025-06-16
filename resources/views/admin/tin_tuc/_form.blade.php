<div class="row g-2">
    <div class="row">
        <div class="col-lg-2">
            <div class="d-flex flex-column align-items-center">
                <label for="hinh_anh" class="form-label">Ảnh đại diện</label>

                <label class="image-upload-wrapper" for="hinh_anh">
                    @if (!empty($tinTuc->hinh_anh))
                        <img id="preview-image" src="{{ asset($tinTuc->hinh_anh) }}" alt="Preview">
                    @else
                        <img id="preview-image" src="#" alt="Preview" style="display: none;">
                        <span class="plus-icon" id="plus-icon">+</span>
                    @endif
                </label>

                <input type="file" name="hinh_anh" id="hinh_anh" accept="image/*">
            </div>
            @error('hinh_anh')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-lg-10">
            <div class="row g-3">
                <div class="col-lg-6">
                    <label for="tieu_de" class="form-label">Tiêu đề</label>
                    <input type="text" class="form-control" name="tieu_de"
                        value="{{ old('tieu_de', $tinTuc->tieu_de ?? '') }}">
                    @error('tieu_de')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-lg-6">
                    <label for="tac_gia" class="form-label">Tác giả</label>
                    <input type="text" class="form-control" name="tac_gia"
                        value="{{ old('tac_gia', $tinTuc->tac_gia ?? '') }}">
                    @error('tac_gia')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-lg-12">
                    <label for="trang_thai" class="form-label">Trạng thái</label>
                    <select class="form-control" name="trang_thai">
                        <option value="hien_thi"
                            {{ old('trang_thai', $tinTuc->trang_thai ?? '') == 'hien_thi' ? 'selected' : '' }}>
                            Hiển thị</option>
                        <option value="nhap"
                            {{ old('trang_thai', $tinTuc->trang_thai ?? '') == 'nhap' ? 'selected' : '' }}>Bản
                            nháp</option>
                    </select>
                    @error('trang_thai')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <label for="mo_ta_ngan" class="form-label">Mô tả ngắn</label>
        <textarea class="form-control" name="mo_ta_ngan">{{ old('mo_ta_ngan', $tinTuc->mo_ta_ngan ?? '') }}</textarea>
        @error('mo_ta_ngan')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="noi_dung" class="form-label">Nội dung</label>
        <textarea class="form-control" name="noi_dung" id="tyni" rows="5">{{ old('noi_dung', $tinTuc->noi_dung ?? '') }}</textarea>
        @error('noi_dung')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <style>
        .image-upload-wrapper {
            width: 120px;
            height: 120px;
            border: 2px dashed #ccc;
            border-radius: 8px;
            cursor: pointer;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background-color: #f8f9fa;
        }

        .image-upload-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .image-upload-wrapper .plus-icon {
            font-size: 32px;
            color: #888;
            position: absolute;
        }

        input[type="file"] {
            display: none;
        }
    </style>








</div>

<div class="text-end">
    <button type="submit" class="btn btn-success">Lưu</button>
    <a href="{{ route('tin_tuc.index') }}" class="btn btn-secondary">Quay lại</a>
</div>
<script>
    const input = document.getElementById('hinh_anh');
    const preview = document.getElementById('preview-image');
    const plusIcon = document.getElementById('plus-icon');

    input.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                if (plusIcon) plusIcon.style.display = 'none';
            };
            reader.readAsDataURL(file);
        }
    });
</script>
