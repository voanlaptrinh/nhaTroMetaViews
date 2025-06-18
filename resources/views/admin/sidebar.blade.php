 <aside id="sidebar" class="sidebar">

     <ul class="sidebar-nav" id="sidebar-nav">

         <li class="nav-item">
             <a class="nav-link collapsed" href="">
                 <i class="bi bi-grid"></i>
                 <span>Dashboard</span>
             </a>
         </li><!-- End Dashboard Nav -->

         <li class="nav-heading">Quản lý vận hành</li>

         <li class="nav-item">
             <a class="nav-link {{ in_array(Request::route()->getName(), ['dichvu.index', 'dichvus.create', 'dichvus.edit']) ? '' : 'collapsed' }}"
                 href="{{ route('dichvu.index') }}">
                 <i class="bi bi-tools"></i>
                 <span>Dịch vụ</span>
             </a>
         </li>

         <li class="nav-item">
             <a class="nav-link {{ in_array(Request::route()->getName(), ['nha_tro.index', 'nha_tro.create', 'nha_tro.edit']) ? '' : 'collapsed' }}"
                 href="{{ route('nha_tro.index') }}">
                 <i class="bi bi-house-door"></i>
                 <span>Nhà trọ</span>
             </a>
         </li>
         <li class="nav-item">
             <a class="nav-link {{ in_array(Request::route()->getName(), ['tai_san_chung_riengs.index', 'tai_san_chung_riengs.create', 'tai_san_chung_riengs.edit']) ? '' : 'collapsed' }}"
                 href="{{ route('tai_san_chung_riengs.index') }}">
                 <i class="bi bi-box"></i>
                 <span>Tài sản trọ</span>
             </a>
         </li>
         <li class="nav-item">
             <a class="nav-link {{ in_array(Request::route()->getName(), ['rooms.index', 'rooms.create', 'rooms.edit']) ? '' : 'collapsed' }}"
                 href="{{ route('rooms.index') }}">
                 <i class="bi bi-door-closed"></i>
                 <span>Phòng trọ</span>
             </a>
         </li>
         <li class="nav-item">
             <a class="nav-link {{ in_array(Request::route()->getName(), ['tai-sans.index', 'tai-sans.create', 'tai-sans.edit']) ? '' : 'collapsed' }}"
                 href="{{ route('tai-sans.index') }}">
                 <i class="bi bi-cash-coin"></i>
                 <span>Tài sản</span>
             </a>
         </li>
           <li class="nav-heading">Phân quyền</li>
            <li class="nav-item">
             <a class="nav-link {{ in_array(Request::route()->getName(), ['roles.index', 'roles.create', 'roles.edit']) ? '' : 'collapsed' }}"
                 href="{{ route('roles.index') }}">
                 <i class="bi bi-person-circle"></i>
                 <span>Vai trò</span>
             </a>
         </li>
         <li class="nav-heading">Khách hàng</li>
         <li class="nav-item">
             <a class="nav-link {{ in_array(Request::route()->getName(), ['admin.users.index', 'admin.users.create', 'admin.users.edit']) ? '' : 'collapsed' }}"
                 href="{{ route('admin.users.index') }}">
                 <i class="bi bi-person-circle"></i>
                 <span>Khách hàng</span>
             </a>
         </li>

         <li class="nav-heading">Hiện thị trang chủ</li>
         <li class="nav-item">
             <a class="nav-link {{ in_array(Request::route()->getName(), ['tin_tuc.index', 'tin_tuc.create', 'tin_tuc.edit']) ? '' : 'collapsed' }}"
                 href="{{ route('tin_tuc.index') }}">
                 <i class="bi bi-newspaper"></i>
                 <span>Tin tức</span>
             </a>
         </li>
         <li class="nav-item">
             <a class="nav-link {{ in_array(Request::route()->getName(), ['lien_he.index.admin']) ? '' : 'collapsed' }}"
                 href="{{ route('lien_he.index.admin') }}">
                 <i class="bi bi-person-lines-fill"></i>
                 <span>Liên hệ</span>
             </a>
         </li>
         <li class="nav-item">
             <a class="nav-link {{ in_array(Request::route()->getName(), ['policies.index', 'policies.create', 'policies.edit']) ? '' : 'collapsed' }}"
                 href="{{ route('policies.index') }}">
                 <i class="bi bi-file-earmark-text"></i>
                 <span>Chính sách</span>
             </a>
         </li>
         <li class="nav-item">
             <a class="nav-link {{ in_array(Request::route()->getName(), ['sliders.index', 'sliders.create', 'sliders.edit']) ? '' : 'collapsed' }}"
                 href="{{ route('sliders.index') }}">
                 <i class="bi bi-images me-2"></i>
                 <span>Sliders</span>
             </a>
         </li>
         <li class="nav-item">
             <a class="nav-link {{ in_array(Request::route()->getName(), ['feedbacks.index', 'feedbacks.create', 'feedbacks.edit']) ? '' : 'collapsed' }}"
                 href="{{ route('feedbacks.index') }}">
                 <i class="bi bi-chat-left-text"></i>
                 <span>Cảm nghĩ</span>
             </a>
         </li>
         <li class="nav-item">
             <a class="nav-link {{ in_array(Request::route()->getName(), ['web-config.edit']) ? '' : 'collapsed' }}"
                 href="{{ route('web-config.edit') }}">
                 <i class="bi bi-gear"></i>
                 <span>Cài đặt web</span>
             </a>
         </li>
         <li class="nav-item">
             <a class="nav-link {{ in_array(Request::route()->getName(), ['about_us.edit']) ? '' : 'collapsed' }}"
                 href="{{ route('about_us.edit') }}">
                 <i class="bi bi-people me-2"></i>
                 <span>Về chúng tôi</span>
             </a>
         </li>


     </ul>

 </aside>
