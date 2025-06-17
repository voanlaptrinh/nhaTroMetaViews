@extends('admin.index')
@section('contentadmin')
    @php
        $isEdit = isset($user);
    @endphp
    <div class="pagetitle">
        <h1>Khách hàng</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item active">{{$isEdit ? 'Sửa khách hàng' : 'Thêm mới khách hàng'}}</li>
            </ol>
        </nav>
    </div>


    <div class="row">

        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <div class="col-12 d-sm-flex justify-content-between align-items-center">
                        <h5 class="card-title">{{$isEdit ? 'Sửa khách hàng' : 'Thêm mới khách hàng'}}</h5>

                    </div>
                    <form method="POST"
                        action="{{ $isEdit ? route('admin.users.update', $user->id) : route('admin.users.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        @if ($isEdit)
                            @method('PUT')
                        @endif
                        <div class="row">
                            <div class="col-lg-3 col-sm-6 col-6 d-flex justify-content-center">
                                <span>
                                    <div class="d-flex flex-column mb-1"><span class="mb-1 false">Ảnh
                                            đại
                                            diện <!----></span>
                                        <div class="position-relative image-container-user mb-2">
                                            <div style="width: 100px; height: 100px; position: relative; overflow: hidden;"
                                                class="mb-2 thumbnail">
                                                <img id="preview-avatar"
                                                    src="{{ $isEdit && $user->avatar ? asset($user->avatar) : '' }}"
                                                    alt="Xem trước ảnh"
                                                    style="width: 100%; height: 100%; object-fit: cover; {{ $isEdit && $user->avatar ? '' : 'display: none;' }}">
                                                <svg id="default-icon-avt" xmlns="http://www.w3.org/2000/svg" width="25px"
                                                    height="25px" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-image"
                                                    style="{{ $isEdit && $user->avatar ? 'display: none;' : '' }} position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                                                    <rect x="3" y="3" width="18" height="18" rx="2"
                                                        ry="2"></rect>
                                                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                                    <polyline points="21 15 16 10 5 21"></polyline>
                                                </svg>
                                            </div>
                                            <input id="avatar" type="file" name="avatar"
                                                accept="image/png, image/jpg, image/jpeg" class="d-none">
                                            <div class="control-btns"><label for="avatar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15px" height="15px"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-edit-2">
                                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                                                        </path>
                                                    </svg>
                                                </label><!---->
                                            </div>
                                        </div>
                                        <small class="text-danger"></small><!---->
                                    </div>
                                </span>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-6 d-flex justify-content-center">
                                <span>
                                    <div class="d-flex flex-column mb-1">
                                        <span class="mb-1">CMND trước</span>
                                        <div class="position-relative image-container-user mb-2">
                                            <div style="width: 100px; height: 100px; position: relative; overflow: hidden;"
                                                class="mb-2 thumbnail">
                                                <img id="preview-cmt-mt"
                                                    src="{{ $isEdit && $user->cmt_mat_truoc ? asset($user->cmt_mat_truoc) : '' }}"
                                                    alt="Xem trước ảnh"
                                                    style="width: 100%; height: 100%; object-fit: cover; {{ $isEdit && $user->cmt_mat_truoc ? '' : 'display: none;' }}">
                                                <svg id="default-icon-cmt-mt" xmlns="http://www.w3.org/2000/svg"
                                                    width="25px" height="25px" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" class="feather feather-image"
                                                    style="{{ $isEdit && $user->cmt_mat_truoc ? 'display: none;' : '' }} position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                                                    <rect x="3" y="3" width="18" height="18" rx="2"
                                                        ry="2"></rect>
                                                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                                    <polyline points="21 15 16 10 5 21"></polyline>
                                                </svg>
                                            </div>
                                            <input id="cmt_mat_truoc" type="file" name="cmt_mat_truoc"
                                                accept="image/png, image/jpg, image/jpeg" class="d-none">
                                            <div class="control-btns">
                                                <label for="cmt_mat_truoc">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15px" height="15px"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-edit-2">
                                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                                                        </path>
                                                    </svg>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </span>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-6 d-flex justify-content-center">
                                <span>
                                    <div class="d-flex flex-column mb-1">
                                        <span class="mb-1">CMND sau</span>
                                        <div class="position-relative image-container-user mb-2">
                                            <div style="width: 100px; height: 100px; position: relative; overflow: hidden;"
                                                class="mb-2 thumbnail">
                                                <img id="preview-cmt-ms"
                                                    src="{{ $isEdit && $user->cmt_mat_sau ? asset($user->cmt_mat_sau) : '' }}"
                                                    alt="Xem trước ảnh"
                                                    style="width: 100%; height: 100%; object-fit: cover; {{ $isEdit && $user->cmt_mat_sau ? '' : 'display: none;' }}">
                                                <svg id="default-icon-cmt-ms" xmlns="http://www.w3.org/2000/svg"
                                                    width="25px" height="25px" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" class="feather feather-image"
                                                    style="{{ $isEdit && $user->cmt_mat_sau ? 'display: none;' : '' }} position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                                                    <rect x="3" y="3" width="18" height="18" rx="2"
                                                        ry="2"></rect>
                                                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                                    <polyline points="21 15 16 10 5 21"></polyline>
                                                </svg>
                                            </div>
                                            <input id="cmt_mat_sau" type="file" name="cmt_mat_sau"
                                                accept="image/png, image/jpg, image/jpeg" class="d-none">
                                            <div class="control-btns">
                                                <label for="cmt_mat_sau">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15px" height="15px"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-edit-2">
                                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                                                        </path>
                                                    </svg>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </span>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-6 d-flex justify-content-center">
                                <span>
                                    <div class="d-flex flex-column mb-1">
                                        <span class="mb-1">Hộ chiếu</span>
                                        <div class="position-relative image-container-user mb-2">
                                            <div style="width: 100px; height: 100px; position: relative; overflow: hidden;"
                                                class="mb-2 thumbnail">
                                                <img id="preview-hc"
                                                    src="{{ $isEdit && $user->ho_chieu ? asset($user->ho_chieu) : '' }}"
                                                    alt="Xem trước ảnh"
                                                    style="width: 100%; height: 100%; object-fit: cover; {{ $isEdit && $user->ho_chieu ? '' : 'display: none;' }}">
                                                <svg id="default-icon-hc" xmlns="http://www.w3.org/2000/svg"
                                                    width="25px" height="25px" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" class="feather feather-image"
                                                    style="{{ $isEdit && $user->ho_chieu ? 'display: none;' : '' }} position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                                                    <rect x="3" y="3" width="18" height="18" rx="2"
                                                        ry="2"></rect>
                                                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                                    <polyline points="21 15 16 10 5 21"></polyline>
                                                </svg>
                                            </div>
                                            <input id="ho_chieu" type="file" name="ho_chieu"
                                                accept="image/png, image/jpg, image/jpeg" class="d-none">
                                            <div class="control-btns">
                                                <label for="ho_chieu">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15px" height="15px"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-edit-2">
                                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                                                        </path>
                                                    </svg>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </span>
                            </div>

                        </div>
                        <div class="form-group">
                            <label>Họ tên</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ old('name', $user->name ?? '') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', $user->email ?? '') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Mật khẩu {{ $isEdit ? '(Để trống nếu không đổi)' : '' }}</label>
                            <input type="password" name="password" class="form-control" {{ $isEdit ? '' : 'required' }}>
                        </div>

                        {{-- <div class="form-group">
            <label>Ảnh đại diện</label>
            <input type="file" name="avatar" class="form-control">
            @if ($isEdit && $user->avatar)
                <img src="{{ asset($user->avatar) }}" width="100">
            @endif
        </div> --}}


                        <div class="form-group">
                            <label>Ngày sinh</label>
                            <input type="date" name="birthday" class="form-control"
                                value="{{ old('birthday', $user->birthday ?? '') }}">
                        </div>

                        <div class="form-group">
                            <label>Số điện thoại</label>
                            <input type="text" name="phone" class="form-control"
                                value="{{ old('phone', $user->phone ?? '') }}">
                        </div>

                        <div class="form-group">
                            <label>CMND</label>
                            <input type="text" name="cmnd" class="form-control"
                                value="{{ old('cmnd', $user->cmnd ?? '') }}">
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
                            <input type="text" name="huyen" class="form-control"
                                value="{{ old('huyen', $user->huyen ?? '') }}">
                        </div>

                        <div class="form-group">
                            <label>Xã</label>
                            <input type="text" name="xa" class="form-control"
                                value="{{ old('xa', $user->xa ?? '') }}">
                        </div>

                        <div class="form-group">
                            <label>Địa chỉ</label>
                            <input type="text" name="address" class="form-control"
                                value="{{ old('address', $user->address ?? '') }}">
                        </div>

                        <div class="form-group">
                            <label>Số tài khoản</label>
                            <input type="text" name="stk" class="form-control"
                                value="{{ old('stk', $user->stk ?? '') }}">
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
                                <option value="1" {{ old('active', $user->active ?? 1) == 1 ? 'selected' : '' }}>Có
                                </option>
                                <option value="0" {{ old('active', $user->active ?? 1) == 0 ? 'selected' : '' }}>
                                    Không</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function setupImagePreview(inputId, previewId, iconId) {
            const input = document.getElementById(inputId);
            const preview = document.getElementById(previewId);
            const icon = document.getElementById(iconId);

            input.addEventListener('change', (e) => {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (evt) => {
                        preview.src = evt.target.result;
                        preview.style.display = 'block';
                        icon.style.display = 'none';
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        setupImagePreview('avatar', 'preview-avatar', 'default-icon-avt');
        setupImagePreview('cmt_mat_truoc', 'preview-cmt-mt', 'default-icon-cmt-mt');
        setupImagePreview('cmt_mat_sau', 'preview-cmt-ms', 'default-icon-cmt-ms');
        setupImagePreview('ho_chieu', 'preview-hc', 'default-icon-hc');
    </script>
@endsection
