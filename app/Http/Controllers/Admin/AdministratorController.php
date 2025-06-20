<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\LogHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AdministratorController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Loại bỏ user có role 'nguoi-thue-tro'
        $query->whereDoesntHave('roles', function ($q) {
            $q->where('name', 'nguoi-thue-tro');
        });

        // Tìm kiếm theo tên
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Tìm kiếm theo email
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        // Lọc theo trạng thái active (0 hoặc 1)
        if ($request->has('active') && $request->active !== '') {
            $query->where('active', $request->active);
        }

        // 👉 Sắp xếp theo ngày tạo mới nhất
        $query->orderBy('created_at', 'desc');

        $administractors = $query->paginate(20);

        return view('admin.administractor.index', compact('administractors'));
    }

    public function create()
    {
        
        $roles = Role::where('name', '!=', 'nguoi-thue-tro')->get();
        $user = null;
        return view('admin.administractor.form', compact('roles', 'user'));
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

        $user->save();
        $user->syncRoles($request->roles);
        LogHelper::ghi('Thêm Người quản lý mới bởi. ' . $request->name, 'Quản lý', 'Thêm quản lý mới trong quản trị viên bởi' . Auth::user()->name);
        return redirect()->route('admin.quanly.index')->with('success', 'Dữ liệu quản lý đã được thêm mới.');
    }

    public function edit(User $user)
    {
         if ($user->roles()->where('name', 'nguoi-thue-tro')->exists()) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
        $roles = Role::where('name', '!=', 'nguoi-thue-tro')->get();
        return view('admin.administractor.form', compact('user', 'roles'));
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

            // Xóa ảnh cũ nếu có
            if (!empty($user->avatar) && file_exists(public_path($user->avatar))) {
                @unlink(public_path($user->avatar));
            }

            $file = $request->file('avatar');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);
            $user->avatar = 'uploads/users/' . $filename;
        }

        // Upload CMT mặt trước
        if ($request->hasFile('cmt_mat_truoc')) {
            if (!empty($user->cmt_mat_truoc) && file_exists(public_path($user->cmt_mat_truoc))) {
                @unlink(public_path($user->cmt_mat_truoc));
            }


            $file = $request->file('cmt_mat_truoc');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);
            $user->cmt_mat_truoc = 'uploads/users/' . $filename;
        }

        // Upload CMT mặt sau
        if ($request->hasFile('cmt_mat_sau')) {
            if (!empty($user->cmt_mat_sau) && file_exists(public_path($user->cmt_mat_sau))) {
                @unlink(public_path($user->cmt_mat_sau));
            }


            $file = $request->file('cmt_mat_sau');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);
            $user->cmt_mat_sau = 'uploads/users/' . $filename;
        }

        // Upload hộ chiếu
        if ($request->hasFile('ho_chieu')) {

            if (!empty($user->ho_chieu) && file_exists(public_path($user->ho_chieu))) {
                @unlink(public_path($user->ho_chieu));
            }

            $file = $request->file('ho_chieu');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);
            $user->ho_chieu = 'uploads/users/' . $filename;
        }
        $user->save();
        $user->syncRoles($request->roles);
        LogHelper::ghi('Cập nhật quản lý mới bởi. ' . $request->name, 'Quản lý', 'Cập nhật trong quản trị bởi' . Auth::user()->name);
        return redirect()->route('admin.quanly.index')->with('success', 'Dữ liệu quản lý đã được cập nhật.');
    }


    public function destroy($id)
    {

        $user = User::findOrFail($id);
        // Kiểm tra nếu user có role 'nguoi-thue-tro' thì không cho xóa
        if ($user->roles()->where('name', 'nguoi-thue-tro')->exists()) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
        $user->delete();
        LogHelper::ghi('Xóa quản lý mới bởi. ' . $user->name, 'Quản lý', 'Xóa trong quản trị bởi' . Auth::user()->name);
        return redirect()->route('admin.users.index')->with('success', 'Xóa user thành công!');
    }
}
