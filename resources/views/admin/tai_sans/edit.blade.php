<div class="container">
    <h2>Sửa tài sản</h2>
    <form method="POST" action="{{ route('tai-sans.update', $taiSan->id) }}">
        @csrf
        @method('PUT')
        @include('admin.tai_sans.form')
    </form>
</div>