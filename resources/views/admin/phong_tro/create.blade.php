<form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('admin.phong_tro.form', ['room' => null])
    <button type="submit" class="btn btn-primary">Thêm phòng</button>
</form>
