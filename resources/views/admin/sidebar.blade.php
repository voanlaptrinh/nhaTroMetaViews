 <aside id="sidebar" class="sidebar">

     <ul class="sidebar-nav" id="sidebar-nav">

         <li class="nav-item">
             <a class="nav-link collapsed" href="">
                 <i class="bi bi-grid"></i>
                 <span>Dashboard</span>
             </a>
         </li><!-- End Dashboard Nav -->

         <li class="nav-heading">Quản lý vận hành</li>
         @if (auth()->user()->hasPermissionTo('Xem dịch vụ') ||
                 auth()->user()->hasPermissionTo('Thêm dịch vụ') ||
                 auth()->user()->hasPermissionTo('Sửa dịch vụ') ||
                 auth()->user()->hasPermissionTo('Xóa dịch vụ'))
             <li class="nav-item">
                 <a class="nav-link {{ in_array(Request::route()->getName(), ['dichvu.index', 'dichvus.create', 'dichvus.edit']) ? '' : 'collapsed' }}"
                     href="{{ route('dichvu.index') }}">
                     <i class="bi bi-tools"></i>
                     <span>Dịch vụ</span>
                 </a>
             </li>
         @endif
         @if (auth()->user()->hasPermissionTo('Xem nhà trọ') ||
                 auth()->user()->hasPermissionTo('Thêm nhà trọ') ||
                 auth()->user()->hasPermissionTo('Sửa nhà trọ') ||
                 auth()->user()->hasPermissionTo('Xóa nhà trọ'))
             <li class="nav-item">
                 <a class="nav-link {{ in_array(Request::route()->getName(), ['nha_tro.index', 'nha_tro.create', 'nha_tro.edit']) ? '' : 'collapsed' }}"
                     href="{{ route('nha_tro.index') }}">
                     <i class="bi bi-house-door"></i>
                     <span>Nhà trọ</span>
                 </a>
             </li>
         @endif
         @if (auth()->user()->hasPermissionTo('Xem phòng trọ') ||
                 auth()->user()->hasPermissionTo('Thêm phòng trọ') ||
                 auth()->user()->hasPermissionTo('Sửa phòng trọ') ||
                 auth()->user()->hasPermissionTo('Xóa phòng trọ'))
             <li class="nav-item">
                 <a class="nav-link {{ in_array(Request::route()->getName(), ['rooms.index', 'rooms.create', 'rooms.edit']) ? '' : 'collapsed' }}"
                     href="{{ route('rooms.index') }}">
                     <i class="bi bi-door-closed"></i>
                     <span>Phòng trọ</span>
                 </a>
             </li>
         @endif
         @if (auth()->user()->hasPermissionTo('Xem tài sản trọ') ||
                 auth()->user()->hasPermissionTo('Thêm tài sản trọ') ||
                 auth()->user()->hasPermissionTo('Sửa tài sản trọ') ||
                 auth()->user()->hasPermissionTo('Xóa tài sản trọ'))
             <li class="nav-item">
                 <a class="nav-link {{ in_array(Request::route()->getName(), ['tai_san_chung_riengs.index', 'tai_san_chung_riengs.create', 'tai_san_chung_riengs.edit']) ? '' : 'collapsed' }}"
                     href="{{ route('tai_san_chung_riengs.index') }}">
                     <i class="bi bi-box"></i>
                     <span>Tài sản trọ</span>
                 </a>
             </li>
         @endif

         @if (auth()->user()->hasPermissionTo('Xem tài sản') ||
                 auth()->user()->hasPermissionTo('Thêm tài sản') ||
                 auth()->user()->hasPermissionTo('Sửa tài sản') ||
                 auth()->user()->hasPermissionTo('Xóa tài sản'))
             <li class="nav-item">
                 <a class="nav-link {{ in_array(Request::route()->getName(), ['tai-sans.index', 'tai-sans.create', 'tai-sans.edit']) ? '' : 'collapsed' }}"
                     href="{{ route('tai-sans.index') }}">
                     <i class="bi bi-cash-coin"></i>
                     <span>Tài sản</span>
                 </a>
             </li>
         @endif
         <li class="nav-heading">Phân quyền</li>
         @if (auth()->user()->hasPermissionTo('Xem vai trò') ||
                 auth()->user()->hasPermissionTo('Thêm vai trò') ||
                 auth()->user()->hasPermissionTo('Sửa vai trò') ||
                 auth()->user()->hasPermissionTo('Xóa vai trò'))
             <li class="nav-item">
                 <a class="nav-link {{ in_array(Request::route()->getName(), ['roles.index', 'roles.create', 'roles.edit']) ? '' : 'collapsed' }}"
                     href="{{ route('roles.index') }}">
                     <i class="bi bi-shield-lock"></i>
                     <span>Vai trò</span>
                 </a>
             </li>
         @endif
         @if (auth()->user()->hasPermissionTo('Xem tài khoản quản trị') ||
                 auth()->user()->hasPermissionTo('Thêm tài khoản quản trị') ||
                 auth()->user()->hasPermissionTo('Sửa tài khoản quản trị') ||
                 auth()->user()->hasPermissionTo('Xóa tài khoản quản trị'))
             <li class="nav-item">
                 <a class="nav-link {{ in_array(Request::route()->getName(), ['admin.quanly.index']) ? '' : 'collapsed' }}"
                     href="{{ route('admin.quanly.index') }}">
                     <i class="bi bi-person-circle"></i>
                     <span>Quản trị</span>
                 </a>
             </li>
         @endif

         <li class="nav-heading">Khách hàng</li>
         @if (auth()->user()->hasPermissionTo('Xem người dùng') ||
                 auth()->user()->hasPermissionTo('Thêm người dùng') ||
                 auth()->user()->hasPermissionTo('Sửa người dùng') ||
                 auth()->user()->hasPermissionTo('Xóa người dùng'))
             <li class="nav-item">
                 <a class="nav-link {{ in_array(Request::route()->getName(), ['admin.users.index', 'admin.users.create', 'admin.users.edit']) ? '' : 'collapsed' }}"
                     href="{{ route('admin.users.index') }}">
                     <i class="bi bi-person-circle"></i>
                     <span>Khách hàng</span>
                 </a>
             </li>
         @endif
         @if (auth()->user()->hasPermissionTo('Xem phương tiện') ||
                 auth()->user()->hasPermissionTo('Thêm phương tiện') ||
                 auth()->user()->hasPermissionTo('Sửa phương tiện') ||
                 auth()->user()->hasPermissionTo('Xóa phương tiện'))
             <li class="nav-item">
                 <a class="nav-link {{ in_array(Request::route()->getName(), ['admin.phuong_tiens.index', 'admin.phuong_tiens.create', 'admin.phuong_tiens.edit']) ? '' : 'collapsed' }}"
                     href="{{ route('admin.phuong_tiens.index') }}">
                     <i class="bi bi-bicycle"></i>
                     <span>Phương tiện</span>
                 </a>
             </li>
         @endif

         <li class="nav-heading">Hiện thị trang chủ</li>
         @if (auth()->user()->hasPermissionTo('Xem tin tức') ||
                 auth()->user()->hasPermissionTo('Thêm tin tức') ||
                 auth()->user()->hasPermissionTo('Sửa tin tức') ||
                 auth()->user()->hasPermissionTo('Xóa tin tức'))
             <li class="nav-item">
                 <a class="nav-link {{ in_array(Request::route()->getName(), ['tin_tuc.index', 'tin_tuc.create', 'tin_tuc.edit']) ? '' : 'collapsed' }}"
                     href="{{ route('tin_tuc.index') }}">
                     <i class="bi bi-newspaper"></i>
                     <span>Tin tức</span>
                 </a>
             </li>
         @endif
         @if (auth()->user()->hasPermissionTo('Xem liên hệ'))
             <li class="nav-item">
                 <a class="nav-link {{ in_array(Request::route()->getName(), ['lien_he.index.admin']) ? '' : 'collapsed' }}"
                     href="{{ route('lien_he.index.admin') }}">
                     <i class="bi bi-person-lines-fill"></i>
                     <span>Liên hệ</span>
                 </a>
             </li>
         @endif
         @if (auth()->user()->hasPermissionTo('Xem chính sách') ||
                 auth()->user()->hasPermissionTo('Thêm chính sách') ||
                 auth()->user()->hasPermissionTo('Sửa chính sách') ||
                 auth()->user()->hasPermissionTo('Xóa chính sách'))
             <li class="nav-item">
                 <a class="nav-link {{ in_array(Request::route()->getName(), ['policies.index', 'policies.create', 'policies.edit']) ? '' : 'collapsed' }}"
                     href="{{ route('policies.index') }}">
                     <i class="bi bi-file-earmark-text"></i>
                     <span>Chính sách</span>
                 </a>
             </li>
         @endif
         @if (auth()->user()->hasPermissionTo('Xem slider') ||
                 auth()->user()->hasPermissionTo('Thêm slider') ||
                 auth()->user()->hasPermissionTo('Sửa slider') ||
                 auth()->user()->hasPermissionTo('Xóa slider'))
             <li class="nav-item">
                 <a class="nav-link {{ in_array(Request::route()->getName(), ['sliders.index', 'sliders.create', 'sliders.edit']) ? '' : 'collapsed' }}"
                     href="{{ route('sliders.index') }}">
                     <i class="bi bi-images me-2"></i>
                     <span>Sliders</span>
                 </a>
             </li>
         @endif
         @if (auth()->user()->hasPermissionTo('Xem cảm nghĩ') ||
                 auth()->user()->hasPermissionTo('Thêm cảm nghĩ') ||
                 auth()->user()->hasPermissionTo('Sửa cảm nghĩ') ||
                 auth()->user()->hasPermissionTo('Xóa cảm nghĩ'))
             <li class="nav-item">
                 <a class="nav-link {{ in_array(Request::route()->getName(), ['feedbacks.index', 'feedbacks.create', 'feedbacks.edit']) ? '' : 'collapsed' }}"
                     href="{{ route('feedbacks.index') }}">
                     <i class="bi bi-chat-left-text"></i>
                     <span>Cảm nghĩ</span>
                 </a>
             </li>
         @endif
         @if (auth()->user()->hasPermissionTo('Cài đặt web'))
             <li class="nav-item">
                 <a class="nav-link {{ in_array(Request::route()->getName(), ['web-config.edit']) ? '' : 'collapsed' }}"
                     href="{{ route('web-config.edit') }}">
                     <i class="bi bi-gear"></i>
                     <span>Cài đặt web</span>
                 </a>
             </li>
         @endif
         @if (auth()->user()->hasPermissionTo('Về chúng tôi'))
             <li class="nav-item">
                 <a class="nav-link {{ in_array(Request::route()->getName(), ['about_us.edit']) ? '' : 'collapsed' }}"
                     href="{{ route('about_us.edit') }}">
                     <i class="bi bi-people me-2"></i>
                     <span>Về chúng tôi</span>
                 </a>
             </li>
         @endif

     </ul>

 </aside>
