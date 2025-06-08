<div class="container">
    <h2>Cập nhật nhà trọ</h2>
    <form action="{{ route('nha_tro.update', $nhaTro->id) }}" method="POST">
        @csrf @method('PUT')
        @include('admin.nha_tro.form', ['nhaTro' => $nhaTro])
        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('nha_tro.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>