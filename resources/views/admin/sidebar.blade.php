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
             <a class="nav-link " data-bs-target="#components-nav" data-bs-toggle="collapse" href="#"
                 aria-expanded="false">
                 <i class="bi bi-menu-button-wide"></i><span>Components</span><i class="bi bi-chevron-down ms-auto"></i>
             </a>
             <ul id="components-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav" style="">
                 <li>
                     <a href="components-alerts.html">
                         <i class="bi bi-circle"></i><span>Alerts</span>
                     </a>
                 </li>

             </ul>
         </li>
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


         <li class="nav-heading">Pages</li>



         <li class="nav-item">
             <a class="nav-link collapsed" href="">
                 <i class="bi bi-file-earmark"></i>
                 <span>Blank</span>
             </a>
         </li><!-- End Blank Page Nav -->

     </ul>

 </aside>
