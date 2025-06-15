@extends('admin.index')
@section('contentadmin')
<div class="container">
    <h3>{{ isset($feedback) ? 'Sửa cảm nghĩ' : 'Thêm cảm nghĩ' }}</h3>
    <form action="{{ isset($feedback) ? route('feedbacks.update', $feedback) : route('feedbacks.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($feedback)) @method('PUT') @endif

        <div class="mb-3">
            <label>Tên</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $feedback->name ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label>Chức vụ</label>
            <input type="text" name="position" class="form-control" value="{{ old('position', $feedback->position ?? '') }}">
        </div>
        <div class="mb-3">
            <label>Ảnh đại diện</label>
            <input type="file" name="image" class="form-control">
            @if(isset($feedback) && $feedback->image)
                <img src="{{ asset($feedback->image) }}" height="80" class="mt-2">
            @endif
        </div>
        <div class="mb-3">
            <label>Nội dung cảm nghĩ</label>
            <textarea name="message" class="form-control" rows="4" required>{{ old('message', $feedback->message ?? '') }}</textarea>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="active" class="form-check-input" value="1" {{ old('active', $feedback->active ?? true) ? 'checked' : '' }}>
            <label class="form-check-label">Hiển thị</label>
        </div>

        <button class="btn btn-success">{{ isset($feedback) ? 'Cập nhật' : 'Thêm mới' }}</button>
    </form>
</div>
@endsection
