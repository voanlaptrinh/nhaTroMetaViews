@extends('admin.index')
@section('contentadmin')
    <div class="pagetitle">
        <h1>Nhà trọ</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item active">Nhà trọ</li>
            </ol>
        </nav>
    </div>




    <div class="row">

        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <div class="col-12 d-sm-flex justify-content-between align-items-center">
                        <h5 class="card-title">Nội dung Nhà trọ</h5>
                        @if (auth()->user()->hasPermissionTo('Thêm nhà trọ'))
                            <a href="{{ route('nha_tro.create') }}" class="btn btn-success rounded-pill">Thêm nhà trọ</a>
                        @endif
                    </div>
                    <hr>
                    <form method="GET" action="{{ route('nha_tro.index') }}" class="mb-3">
                        <div class="row">
                            <div class="col-md-2">
                                <input type="text" name="ten_toa_nha" class="form-control" placeholder="Tên tòa nhà"
                                    value="{{ request('ten_toa_nha') }}">
                            </div>
                            <div class="col-md-2">
                                <input type="text" name="ma_toa_nha" class="form-control" placeholder="Mã tòa nhà"
                                    value="{{ request('ma_toa_nha') }}">
                            </div>
                            <div class="col-md-2">
                                <input type="text" name="dia_chi" class="form-control" placeholder="Địa chỉ"
                                    value="{{ request('dia_chi') }}">
                            </div>
                            <div class="col-md-2">
                                <input type="text" name="quan" class="form-control" placeholder="Quận/Huyện"
                                    value="{{ request('quan') }}">
                            </div>
                            <div class="col-md-2">
                                <input type="text" name="thanh_pho" class="form-control" placeholder="Thành phố"
                                    value="{{ request('thanh_pho') }}">
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary w-100" type="submit">Tìm kiếm</button>
                            </div>
                        </div>
                    </form>



                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Tên tòa nhà</th>
                                    <th>Mã</th>
                                    <th>Địa chỉ</th>
                                    <th>Số tầng</th>
                                    <th>Dịch vụ</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($nhaTros as $nhaTro)
                                    <tr>
                                        <td>{{ $nhaTro->ten_toa_nha }}</td>
                                        <td>{{ $nhaTro->ma_toa_nha }}</td>
                                        <td>{{ $nhaTro->dia_chi }}</td>
                                        <td>{{ $nhaTro->so_tang }}</td>
                                        <td>
                                            @foreach ($nhaTro->dichVus as $dv)
                                                <span
                                                    class="badge border border-primary border-1 text-primary">{{ $dv->ten_dich_vu }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @if (auth()->user()->hasPermissionTo('Sửa nhà trọ'))
                                                <a href="{{ route('nha_tro.edit', $nhaTro->id) }}"
                                                    class="btn btn-warning"><i class="bi bi-wrench"></i></a>
                                            @endif
                                            @if (auth()->user()->hasPermissionTo('Xóa nhà trọ'))
                                                <form action="{{ route('nha_tro.destroy', $nhaTro->id) }}" method="POST"
                                                    style="display:inline-block;">
                                                    @csrf @method('DELETE')
                                                    <button class="btn btn-danger"
                                                        onclick="return confirm('Xóa nhà trọ này?')"><i
                                                            class="bi bi-trash text-white"></i></button>
                                                </form>
                                            @endif
                                            <button type="button" class="btn btn-info btn-xem-chi-tiet"
                                                data-bs-toggle="modal" data-bs-target="#modalChiTiet"
                                                data-nhatro='@json($nhaTro)'
                                                data-dichvus='@json($nhaTro->dichVus)'>
                                                <i class="bi bi-eye"></i>
                                            </button>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">Không có dữ liệu nhà trọ.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class=" p-nav text-end d-flex justify-content-end">
                        {{ $nhaTros->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Modal chi tiết -->
    <div class="modal fade" id="modalChiTiet" tabindex="-1" aria-labelledby="modalChiTietLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title" id="modalChiTietLabel">Chi tiết nhà trọ</h5>
                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <p><strong>Tên tòa nhà:</strong> <span id="chiTiet-ten"></span></p>
                        </div>
                        <div class="col-6">
                            <p><strong>Mã tòa nhà:</strong> <span id="chiTiet-ma"></span></p>
                        </div>
                        <div class="col-6">
                            <p><strong>Địa chỉ:</strong> <span id="chiTiet-diachi"></span></p>
                        </div>
                        <div class="col-6">
                            <p><strong>Số tầng:</strong> <span id="chiTiet-tang"></span></p>
                        </div>
                        <div class="col-6">
                            <p><strong>Phường/Xã:</strong> <span id="chiTiet-phuong"></span></p>
                        </div>
                        <div class="col-6">
                            <p><strong>Quận/Huyện:</strong> <span id="chiTiet-quan"></span></p>
                        </div>
                        <div class="col-6">
                            <p><strong>Thành phố:</strong> <span id="chiTiet-thanhpho"></span></p>
                        </div>
                        <div class="col-6">
                            <p><strong>Diện tích:</strong> <span id="chiTiet-dientich"></span> m2</p>
                        </div>
                        <div class="col-6">
                            <p><strong>Số tầng:</strong> <span id="chiTiet-sotang"></span></p>
                        </div>
                        <div class="col-6">
                            <p><strong>Số phòng/ tầng:</strong> <span id="chiTiet-sotangphong"></span></p>
                        </div>
                    </div>
                    <p><strong>Dịch vụ:</strong> <span id="chiTiet-dichvus"></span></p>
                    <p id="mo-ta-row" style="display: none;"><strong>Mô tả:</strong> <span id="chiTiet-mo-ta"></span></p>

                </div>
            </div>
        </div>
    </div>
    <script>
        document.querySelectorAll('.btn-xem-chi-tiet').forEach(btn => {
            btn.addEventListener('click', function() {
                const nhaTro = JSON.parse(this.getAttribute('data-nhatro'));
                const dichVus = JSON.parse(this.getAttribute('data-dichvus'));

                document.getElementById('chiTiet-ten').textContent = nhaTro.ten_toa_nha;
                document.getElementById('chiTiet-ma').textContent = nhaTro.ma_toa_nha;
                document.getElementById('chiTiet-diachi').textContent = nhaTro.dia_chi;
                document.getElementById('chiTiet-tang').textContent = nhaTro.so_tang;
                document.getElementById('chiTiet-phuong').textContent = nhaTro.phuong;
                document.getElementById('chiTiet-quan').textContent = nhaTro.quan;
                document.getElementById('chiTiet-thanhpho').textContent = nhaTro.thanh_pho;
                document.getElementById('chiTiet-dientich').textContent = nhaTro.dien_tich;
                document.getElementById('chiTiet-sotang').textContent = nhaTro.so_tang;
                document.getElementById('chiTiet-sotangphong').textContent = nhaTro.so_phong_tang;
                const moTa = nhaTro.mo_ta || '';
                const moTaRow = document.getElementById('mo-ta-row');
                const moTaSpan = document.getElementById('chiTiet-mo-ta');

                if (moTa.trim() !== '') {
                    moTaSpan.textContent = moTa;
                    moTaRow.style.display = 'block';
                } else {
                    moTaSpan.textContent = '';
                    moTaRow.style.display = 'none';
                }

                const dvContainer = document.getElementById('chiTiet-dichvus');
                dvContainer.innerHTML = '';

                if (dichVus.length === 0) {
                    dvContainer.innerHTML = '<em>Không có dịch vụ</em>';
                } else {
                    dichVus.forEach(dv => {
                        const badge = document.createElement('span');
                        badge.className = 'badge bg-primary me-1';
                        badge.textContent = dv.ten_dich_vu;
                        dvContainer.appendChild(badge);
                    });
                }
            });
        });
    </script>
@endsection
