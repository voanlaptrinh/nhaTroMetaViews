<form action="{{ isset($slider) ? route('sliders.update', $slider) : route('sliders.store') }}" method="POST">
    @csrf
    @if (isset($slider))
        @method('PUT')
    @endif

    <div class="row">
        <div class="col-lg-4">
            <div class="mb-3">
                <label>Tiêu đề</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                    value="{{ old('title', $slider->title ?? '') }}">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-lg-4">
            <div class="mb-3">
                <label>Phụ đề</label>
                <input type="text" name="subtitle" class="form-control @error('subtitle') is-invalid @enderror"
                    value="{{ old('subtitle', $slider->subtitle ?? '') }}">
                @error('subtitle')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-lg-4">
            <div class="mb-3">
                <label>Vị trí hiển thị</label>
                <input type="number" name="position" class="form-control @error('position') is-invalid @enderror"
                    value="{{ old('position', $slider->position ?? 0) }}">
                @error('position')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-lg-12">
            <div class="mb-3">
                <label>Liên kết (nếu có)</label>
                <input type="url" name="link" class="form-control @error('link') is-invalid @enderror"
                    value="{{ old('link', $slider->link ?? '') }}">
                @error('link')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-lg-12">
            <div class="checkbox-wrapper-61 mb-3">
                <input type="checkbox" name="active" class="check" id="activeCheckbox" value="1"
                    {{ old('active', $slider->active ?? false) ? 'checked' : '' }}>
                <label for="activeCheckbox" class="label">
                    <svg width="45" height="45" viewBox="0 0 95 95">
                        <rect x="30" y="20" width="50" height="50" stroke="black" fill="none" />
                        <g transform="translate(0,-952.36222)">
                            <path
                                d="m 56,963 c -102,122 6,9 7,9 17,-5 -66,69 -38,52 122,-77 -7,14 18,4 29,-11 45,-43 23,-4 "
                                stroke="black" stroke-width="3" fill="none" class="path1" />
                        </g>
                    </svg>
                    <span>Hiển thị hay không</span>
                </label>
            </div>
            @error('active')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 col-lg-12">
            <label>Hình ảnh (có thể cắt thủ công)</label>
            <input type="file" id="imageInput" accept="image/*"
                class="form-control mb-2 @error('cropped_image') is-invalid @enderror">
            @error('cropped_image')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror

            <div>
                <img id="previewImage" style="max-width: 100%; display: none;" alt="Preview">
            </div>
            <input type="hidden" name="cropped_image" id="croppedImage">

            @if (isset($slider) && $slider->image)
                <div class="mt-2">
                    <strong>Ảnh hiện tại:</strong><br>
                    <img src="{{ asset($slider->image) }}" height="80">
                </div>
            @endif
        </div>
    </div>


    <div class="text-end">
        <button class="btn btn-primary">{{ isset($slider) ? 'Cập nhật' : 'Thêm mới' }}</button>
    </div>
</form>
