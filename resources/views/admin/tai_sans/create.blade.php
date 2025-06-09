<div class="container">
    <h2>Thêm tài sản</h2>
    <form method="POST" action="{{ route('tai-sans.store') }}">
        @csrf
        @include('admin.tai_sans.form')
    </form>
</div>