@extends('admin.index')
@section('contentadmin')
@php
    $isEdit = isset($user);
@endphp

<form method="POST" action="{{ $isEdit ? route('users.update', $user->id) : route('users.store') }}" enctype="multipart/form-data">
    @csrf
    @if ($isEdit)
        @method('PUT')
    @endif

    <div class="form-group">
        <label>Họ tên</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name ?? '') }}" required>
    </div>

    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email ?? '') }}" required>
    </div>

    <div class="form-group">
        <label>Mật khẩu {{ $isEdit ? '(Để trống nếu không đổi)' : '' }}</label>
        <input type="password" name="password" class="form-control" {{ $isEdit ? '' : 'required' }}>
    </div>

    <div class="form-group">
        <label>Ảnh đại diện</label>
        <input type="file" name="avatar" class="form-control">
        @if($isEdit && $user->avatar)
            <img src="{{ asset('avatars/' . $user->avatar) }}" width="100">
        @endif
    </div>

    <div class="form-group">
        <label>Ngày sinh</label>
        <input type="date" name="birthday" class="form-control" value="{{ old('birthday', $user->birthday ?? '') }}">
    </div>

    <div class="form-group">
        <label>Số điện thoại</label>
        <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone ?? '') }}">
    </div>

    <div class="form-group">
        <label>CMND</label>
        <input type="text" name="cmnd" class="form-control" value="{{ old('cmnd', $user->cmnd ?? '') }}">
    </div>

    <div class="form-group">
        <label>Hộ chiếu</label>
        <input type="text" name="ho_chieu" class="form-control" value="{{ old('ho_chieu', $user->ho_chieu ?? '') }}">
    </div>

    <div class="form-group">
        <label>Giới tính</label>
        <input type="text" name="gioi_tinh" class="form-control" value="{{ old('gioi_tinh', $user->gioi_tinh ?? '') }}">
    </div>

    <div class="form-group">
        <label>Ngày cấp CMND</label>
        <input type="text" name="ngay_cap_cmnd" class="form-control" value="{{ old('ngay_cap_cmnd', $user->ngay_cap_cmnd ?? '') }}">
    </div>

    <div class="form-group">
        <label>Nơi cấp CMND</label>
        <input type="text" name="noi_cap_cmnd" class="form-control" value="{{ old('noi_cap_cmnd', $user->noi_cap_cmnd ?? '') }}">
    </div>

    <div class="form-group">
        <label>Thành phố</label>
        <input type="text" name="thanh_pho" class="form-control" value="{{ old('thanh_pho', $user->thanh_pho ?? '') }}">
    </div>

    <div class="form-group">
        <label>Huyện</label>
        <input type="text" name="huyen" class="form-control" value="{{ old('huyen', $user->huyen ?? '') }}">
    </div>

    <div class="form-group">
        <label>Xã</label>
        <input type="text" name="xa" class="form-control" value="{{ old('xa', $user->xa ?? '') }}">
    </div>

    <div class="form-group">
        <label>Địa chỉ</label>
        <input type="text" name="address" class="form-control" value="{{ old('address', $user->address ?? '') }}">
    </div>

    <div class="form-group">
        <label>Số tài khoản</label>
        <input type="text" name="stk" class="form-control" value="{{ old('stk', $user->stk ?? '') }}">
    </div>

    <div class="form-group">
        <label>Ngân hàng</label>
        <input type="text" name="ngan_hang" class="form-control" value="{{ old('ngan_hang', $user->ngan_hang ?? '') }}">
    </div>

    <div class="form-group">
        <label>Nghề nghiệp</label>
        <input type="text" name="nghe_nghiep" class="form-control" value="{{ old('nghe_nghiep', $user->nghe_nghiep ?? '') }}">
    </div>

    <div class="form-group">
        <label>Nơi làm việc</label>
        <input type="text" name="noi_lam_viec" class="form-control" value="{{ old('noi_lam_viec', $user->noi_lam_viec ?? '') }}">
    </div>

    <div class="form-group">
        <label>Mã vân tay</label>
        <input type="text" name="ma_van_tay" class="form-control" value="{{ old('ma_van_tay', $user->ma_van_tay ?? '') }}">
    </div>

    <div class="form-group">
        <label>Ghi chú</label>
        <textarea name="note" class="form-control">{{ old('note', $user->note ?? '') }}</textarea>
    </div>

    <div class="form-group">
        <label>Kích hoạt</label>
        <select name="active" class="form-control">
            <option value="1" {{ old('active', $user->active ?? 1) == 1 ? 'selected' : '' }}>Có</option>
            <option value="0" {{ old('active', $user->active ?? 1) == 0 ? 'selected' : '' }}>Không</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Lưu</button>
</form>
@endsection