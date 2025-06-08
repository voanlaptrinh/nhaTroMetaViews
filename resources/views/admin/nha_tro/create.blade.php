<div class="container">
    <h2>Thêm nhà trọ</h2>
    <form action="{{ route('nha_tro.store') }}" method="POST">
        @csrf
        @include('admin.nha_tro.form', ['nhaTro' => null])
        <button type="submit" class="btn btn-success">Lưu</button>
        <a href="{{ route('nha_tro.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>