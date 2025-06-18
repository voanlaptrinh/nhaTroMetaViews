<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\LogHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query()
            ->role('nguoi-thue-tro'); // chỉ lấy user có quyền này

        // Tìm kiếm theo tên
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Tìm kiếm theo email
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        // Tìm kiếm theo trạng thái
        if ($request->filled('active')) {
            $query->where('active', $request->active); // active là true/false
        }

        $users = $query->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'nullable|string|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'phone' => 'nullable|string',
            'avatar' => 'nullable|image',
            'birthday' => 'nullable|date',
            'cmt_mat_truoc' => 'nullable|image',
            'cmt_mat_sau' => 'nullable|image',
            'cmnd' => 'nullable|string',
            'ho_chieu' => 'nullable|image',
            'gioi_tinh' => 'nullable|string',
            'ngay_cap_cmnd' => 'nullable|string',
            'noi_cap_cmnd' => 'nullable|string',
            'thanh_pho' => 'nullable|string',
            'huyen' => 'nullable|string',
            'xa' => 'nullable|string',
            'address' => 'nullable|string',
            'stk' => 'nullable|string',
            'ngan_hang' => 'nullable|string',
            'nghe_nghiep' => 'nullable|string',
            'noi_lam_viec' => 'nullable|string',
            'ma_van_tay' => 'nullable|string',
            'note' => 'nullable|string',
        ], [
            'name.required' => 'Vui lòng nhập họ tên.',
            'name.max' => 'Họ tên không được vượt quá 255 ký tự.',

            'username.max' => 'Tên đăng nhập không được vượt quá 255 ký tự.',
            'username.unique' => 'Tên đăng nhập đã tồn tại.',

            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email đã tồn tại.',

            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',

            'avatar.image' => 'Ảnh đại diện phải là định dạng hình ảnh (jpg, png, jpeg).',

            'phone.string' => 'Số điện thoại không hợp lệ.',

            'birthday.date' => 'Ngày sinh không đúng định dạng.',

            'cmt_mat_truoc.image' => 'Ảnh mặt trước CMND phải là hình ảnh.',
            'cmt_mat_sau.image' => 'Ảnh mặt sau CMND phải là hình ảnh.',
            'ho_chieu.image' => 'Ảnh hộ chiếu phải là hình ảnh.',

            'cmnd.string' => 'Số CMND không hợp lệ.',
            'gioi_tinh.string' => 'Giới tính không hợp lệ.',
            'ngay_cap_cmnd.string' => 'Ngày cấp CMND không hợp lệ.',
            'noi_cap_cmnd.string' => 'Nơi cấp CMND không hợp lệ.',

            'thanh_pho.string' => 'Tỉnh/Thành phố không hợp lệ.',
            'huyen.string' => 'Quận/Huyện không hợp lệ.',
            'xa.string' => 'Phường/Xã không hợp lệ.',
            'address.string' => 'Địa chỉ không hợp lệ.',

            'stk.string' => 'Số tài khoản không hợp lệ.',
            'ngan_hang.string' => 'Tên ngân hàng không hợp lệ.',
            'nghe_nghiep.string' => 'Nghề nghiệp không hợp lệ.',
            'noi_lam_viec.string' => 'Nơi làm việc không hợp lệ.',

            'ma_van_tay.string' => 'Mã vân tay không hợp lệ.',
            'note.string' => 'Ghi chú không hợp lệ.',
        ]);

        $user = new User($validated);
        $user->password = Hash::make($request->password);

        $uploadPath = public_path('uploads/users');
        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true);
        }

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);
            $user->avatar = 'uploads/users/' . $filename;
        }

        if ($request->hasFile('cmt_mat_truoc')) {
            $file = $request->file('cmt_mat_truoc');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);
            $user->cmt_mat_truoc = 'uploads/users/' . $filename;
        }

        if ($request->hasFile('cmt_mat_sau')) {
            $file = $request->file('cmt_mat_sau');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);
            $user->cmt_mat_sau = 'uploads/users/' . $filename;
        }

        if ($request->hasFile('ho_chieu')) {
            $file = $request->file('ho_chieu');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);
            $user->ho_chieu = 'uploads/users/' . $filename;
        }

        $user->assignRole('nguoi-thue-tro');
        $user->save();
LogHelper::ghi('Thêm Người dụng mới', 'Khách hàng', 'Thêm Người dụng mới trong quản trị viên');
        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        return view('admin.users.form', compact('user'));
    }


    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'nullable|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
            'phone' => 'nullable|string',
            'avatar' => 'nullable|image',
            'birthday' => 'nullable|date',
            'cmt_mat_truoc' => 'nullable|image',
            'cmt_mat_sau' => 'nullable|image',
            'cmnd' => 'nullable|string',
            'ho_chieu' => 'nullable|image',
            'gioi_tinh' => 'nullable|string',
            'ngay_cap_cmnd' => 'nullable|string',
            'noi_cap_cmnd' => 'nullable|string',
            'thanh_pho' => 'nullable|string',
            'huyen' => 'nullable|string',
            'xa' => 'nullable|string',
            'address' => 'nullable|string',
            'stk' => 'nullable|string',
            'ngan_hang' => 'nullable|string',
            'nghe_nghiep' => 'nullable|string',
            'noi_lam_viec' => 'nullable|string',
            'ma_van_tay' => 'nullable|string',
            'note' => 'nullable|string',
        ], [
            'name.required' => 'Vui lòng nhập họ tên.',
            'name.max' => 'Họ tên không được vượt quá 255 ký tự.',

            'username.max' => 'Tên đăng nhập không được vượt quá 255 ký tự.',
            'username.unique' => 'Tên đăng nhập đã tồn tại.',

            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email đã tồn tại.',

            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',

            'phone.string' => 'Số điện thoại không hợp lệ.',

            'avatar.image' => 'Ảnh đại diện phải là một hình ảnh.',
            'birthday.date' => 'Ngày sinh không đúng định dạng.',

            'cmt_mat_truoc.image' => 'Ảnh mặt trước CMND phải là hình ảnh.',
            'cmt_mat_sau.image' => 'Ảnh mặt sau CMND phải là hình ảnh.',
            'ho_chieu.image' => 'Ảnh hộ chiếu phải là hình ảnh.',

            'cmnd.string' => 'Số CMND không hợp lệ.',
            'gioi_tinh.string' => 'Giới tính không hợp lệ.',
            'ngay_cap_cmnd.string' => 'Ngày cấp CMND không hợp lệ.',
            'noi_cap_cmnd.string' => 'Nơi cấp CMND không hợp lệ.',

            'thanh_pho.string' => 'Tỉnh/Thành phố không hợp lệ.',
            'huyen.string' => 'Quận/Huyện không hợp lệ.',
            'xa.string' => 'Phường/Xã không hợp lệ.',
            'address.string' => 'Địa chỉ không hợp lệ.',

            'stk.string' => 'Số tài khoản không hợp lệ.',
            'ngan_hang.string' => 'Tên ngân hàng không hợp lệ.',
            'nghe_nghiep.string' => 'Nghề nghiệp không hợp lệ.',
            'noi_lam_viec.string' => 'Nơi làm việc không hợp lệ.',

            'ma_van_tay.string' => 'Mã vân tay không hợp lệ.',
            'note.string' => 'Ghi chú không hợp lệ.',
        ]);

       
// Nếu có mật khẩu mới thì hash, nếu không thì bỏ khỏi validated
if ($request->filled('password')) {
    $validated['password'] = Hash::make($request->password);
} else {
    unset($validated['password']); // tránh bị gán null
}
 $user->fill($validated);

        // Tạo thư mục lưu ảnh
        $uploadPath = public_path('uploads/users');
        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true);
        }

        // Upload avatar
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);
            $user->avatar = 'uploads/users/' . $filename;
        }

        // Upload CMT mặt trước
        if ($request->hasFile('cmt_mat_truoc')) {
            $file = $request->file('cmt_mat_truoc');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);
            $user->cmt_mat_truoc = 'uploads/users/' . $filename;
        }

        // Upload CMT mặt sau
        if ($request->hasFile('cmt_mat_sau')) {
            $file = $request->file('cmt_mat_sau');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);
            $user->cmt_mat_sau = 'uploads/users/' . $filename;
        }

        // Upload hộ chiếu
        if ($request->hasFile('ho_chieu')) {
            $file = $request->file('ho_chieu');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);
            $user->ho_chieu = 'uploads/users/' . $filename;
        }

        $user->save();
  LogHelper::ghi('Cập nhật khách hàng với id ' . $user->id, 'Khách hàng', 'Cập nhật thông tin Khách hàng trong quản trị viên');
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
