@extends('admin.index')
@section('contentadmin')
<div class="container">
    <h2>Danh sách người dùng</h2>
    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Thêm người dùng</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Họ tên</th>
                <th>Email</th>
                <th>Ảnh</th>
                <th>Ngày sinh</th>
                <th>Hoạt động</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->avatar)
                            <img src="{{ asset( $user->avatar) }}" width="50" height="50">
                        @endif
                    </td>
                    <td>{{ $user->birthday }}</td>
                    <td>{{ $user->active ? 'Có' : 'Không' }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display:inline-block;">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Xoá người dùng này?')" class="btn btn-danger btn-sm">Xoá</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
