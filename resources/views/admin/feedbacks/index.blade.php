@extends('admin.index')
@section('contentadmin')
    <div class="container">
        <h3>Danh sách cảm nghĩ</h3>
        <a href="{{ route('feedbacks.create') }}" class="btn btn-primary mb-3">Thêm cảm nghĩ</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tên</th>
                    <th>Chức vụ</th>
                    <th>Hình ảnh</th>
                    <th>Nội dung</th>
                    <th>Hiển thị</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($feedbacks as $fb)
                    <tr>
                        <td>{{ $fb->name }}</td>
                        <td>{{ $fb->position }}</td>
                        <td>
                            @if ($fb->image)
                                <img src="{{ asset($fb->image) }}" height="60">
                            @endif
                        </td>
                        <td>{{ Str::limit($fb->message, 60) }}</td>
                        <td>{{ $fb->active ? '✔️' : '❌' }}</td>
                        <td>
                            <a href="{{ route('feedbacks.edit', $fb) }}" class="btn btn-sm btn-warning">Sửa</a>
                            <form action="{{ route('feedbacks.destroy', $fb) }}" method="POST" class="d-inline-block"
                                onsubmit="return confirm('Xóa cảm nghĩ này?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">Xóa</button>
                            </form>
                           <button type="button"
    class="btn btn-info btn-sm btn-xem-chi-tiet"
    data-bs-toggle="modal"
    data-bs-target="#modalChiTiet"
    data-ten="{{ $fb->name }}"
    data-chucvu="{{ $fb->position }}"
    data-noidung="{{ $fb->message }}"
    data-anh="{{ $fb->image ? asset($fb->image) : '' }}">
    Xem
</button>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
  <!-- Modal chi tiết cảm nghĩ -->
<div class="modal fade" id="modalChiTiet" tabindex="-1" aria-labelledby="modalChiTietLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content p-3">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex align-items-start flex-wrap">
                    <div class="me-4 mb-3">
                        <img id="ct-anh" src="" alt="Ảnh" class="rounded-circle" style="width: 160px; height: 160px; object-fit: cover;">
                    </div>
                    <div style="flex: 1 1 300px;">
                        <h5 class="text-danger fw-bold" id="ct-ten">Tên</h5>
                        <p class="text-primary fw-semibold" id="ct-chucvu">Chức vụ</p>
                        <p id="ct-noidung" class="text-justify"></p>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <button type="button" class="btn btn-danger px-4" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
</div>

    <script>
   
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('.btn-xem-chi-tiet');

        buttons.forEach(button => {
            button.addEventListener('click', function () {
                document.getElementById('ct-ten').textContent = this.dataset.ten;
                document.getElementById('ct-chucvu').textContent = this.dataset.chucvu || '(Không có)';
                document.getElementById('ct-noidung').textContent = this.dataset.noidung;

                const anh = this.dataset.anh;
                document.getElementById('ct-anh').src = anh || 'https://via.placeholder.com/160?text=No+Image';
            });
        });
    });


    </script>
@endsection
