<form action="{{ route('rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('admin.phong_tro.form', ['room' => $room])
    <button type="submit" class="btn btn-warning">Cập nhật phòng</button>
</form>
