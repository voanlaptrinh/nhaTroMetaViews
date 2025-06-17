@extends('admin.index')
@section('contentadmin')
    @php
        $isEdit = isset($user);
    @endphp

    <form method="POST" action="{{ $isEdit ? route('admin.users.update', $user->id) : route('admin.users.store') }}"
        enctype="multipart/form-data">
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
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email ?? '') }}"
                required>
        </div>

        <div class="form-group">
            <label>Mật khẩu {{ $isEdit ? '(Để trống nếu không đổi)' : '' }}</label>
            <input type="password" name="password" class="form-control" {{ $isEdit ? '' : 'required' }}>
        </div>

        <div class="form-group">
            <label>Ảnh đại diện</label>
            <input type="file" name="avatar" class="form-control">
            @if ($isEdit && $user->avatar)
                <img src="{{ asset($user->avatar) }}" width="100">
            @endif
        </div>
        <style>
            .image-container-user .thumbnail {
                border: 1px solid hsla(0, 0%, 78.4%, .5);
                border-radius: 8px;
            }

            .image-container-user {
                width: fit-content;
            }

            .image-container-user .empty-img {
                display: flex;
                justify-content: center;
                align-items: center;

            }

            .image-container-user .control-btns>label {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 25px;
                height: 25px;
                position: absolute;
            }

            .image-container-user .control-btns>label {
                left: calc(100% - 15px);
            }

            .image-container-user .control-btns>label:first-child {
                top: -8px;
            }

            .image-container-user .control-btns>label:last-child {
                bottom: -8px;
            }

            .image-container-user .control-btns>label {
                border: 0;
                background-color: #fff;
                border-radius: 50%;
                box-shadow: 0 0 5px #c5c5c5;
                cursor: pointer;
            }
        </style>
        <div class="col-3"><span>
                 <div data-v-5a4b454b="" class="d-flex flex-column mb-1"><span data-v-5a4b454b="" class="mb-1 false">Ảnh
                        đại
                        diện <!----></span>
                    <div data-v-5a4b454b="" class="position-relative image-container-user mb-2">
                        <div data-v-5a4b454b="" class="empty-img thumbnail" style="width: 100px; height: 100px;"><svg
                                data-v-5a4b454b="" xmlns="http://www.w3.org/2000/svg" width="25px" height="25px"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-image">
                                <rect data-v-5a4b454b="" x="3" y="3" width="18" height="18" rx="2"
                                    ry="2"></rect>
                                <circle data-v-5a4b454b="" cx="8.5" cy="8.5" r="1.5"></circle>
                                <polyline data-v-5a4b454b="" points="21 15 16 10 5 21"></polyline>
                            </svg></div><input data-v-5a4b454b="" id="file-input-avatar" type="file"
                            name="file-input-avatar" accept="image/png, image/jpg, image/jpeg" class="d-none">
                        <div data-v-5a4b454b="" class="control-btns"><label data-v-5a4b454b="" for="file-input-avatar"><svg
                                    data-v-5a4b454b="" xmlns="http://www.w3.org/2000/svg" width="15px" height="15px"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2">
                                    <path data-v-5a4b454b="" d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                                    </path>
                                </svg></label><!----></div>
                    </div><small data-v-5a4b454b="" class="text-danger"></small><!---->
                </div>
            </span></div>
       
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
            <input type="text" name="gioi_tinh" class="form-control"
                value="{{ old('gioi_tinh', $user->gioi_tinh ?? '') }}">
        </div>

        <div class="form-group">
            <label>Ngày cấp CMND</label>
            <input type="text" name="ngay_cap_cmnd" class="form-control"
                value="{{ old('ngay_cap_cmnd', $user->ngay_cap_cmnd ?? '') }}">
        </div>

        <div class="form-group">
            <label>Nơi cấp CMND</label>
            <input type="text" name="noi_cap_cmnd" class="form-control"
                value="{{ old('noi_cap_cmnd', $user->noi_cap_cmnd ?? '') }}">
        </div>

        <div class="form-group">
            <label>Thành phố</label>
            <input type="text" name="thanh_pho" class="form-control"
                value="{{ old('thanh_pho', $user->thanh_pho ?? '') }}">
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
            <input type="text" name="address" class="form-control"
                value="{{ old('address', $user->address ?? '') }}">
        </div>

        <div class="form-group">
            <label>Số tài khoản</label>
            <input type="text" name="stk" class="form-control" value="{{ old('stk', $user->stk ?? '') }}">
        </div>

        <div class="form-group">
            <label>Ngân hàng</label>
            <input type="text" name="ngan_hang" class="form-control"
                value="{{ old('ngan_hang', $user->ngan_hang ?? '') }}">
        </div>

        <div class="form-group">
            <label>Nghề nghiệp</label>
            <input type="text" name="nghe_nghiep" class="form-control"
                value="{{ old('nghe_nghiep', $user->nghe_nghiep ?? '') }}">
        </div>

        <div class="form-group">
            <label>Nơi làm việc</label>
            <input type="text" name="noi_lam_viec" class="form-control"
                value="{{ old('noi_lam_viec', $user->noi_lam_viec ?? '') }}">
        </div>

        <div class="form-group">
            <label>Mã vân tay</label>
            <input type="text" name="ma_van_tay" class="form-control"
                value="{{ old('ma_van_tay', $user->ma_van_tay ?? '') }}">
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
