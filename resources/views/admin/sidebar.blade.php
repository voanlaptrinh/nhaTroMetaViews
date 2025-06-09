 <aside id="sidebar" class="sidebar">

     <ul class="sidebar-nav" id="sidebar-nav">

         <li class="nav-item">
             <a class="nav-link collapsed" href="">
                 <i class="bi bi-grid"></i>
                 <span>Dashboard</span>
             </a>
         </li><!-- End Dashboard Nav -->
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
             <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                 <i class="bi bi-menu-button-wide"></i><span>Components</span><i class="bi bi-chevron-down ms-auto"></i>
             </a>
             <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                 <li>
                     <a href="https://bootstrapmade.com/content/demo/NiceAdmin/components-alerts.html">
                         <i class="bi bi-circle"></i><span>Alerts</span>
                     </a>
                 </li>
                 <li>
                     <a href="https://bootstrapmade.com/content/demo/NiceAdmin/components-accordion.html">
                         <i class="bi bi-circle"></i><span>Accordion</span>
                     </a>
                 </li>
                 <li>
                     <a href="https://bootstrapmade.com/content/demo/NiceAdmin/components-badges.html">
                         <i class="bi bi-circle"></i><span>Badges</span>
                     </a>
                 </li>
                 <li>
                     <a href="https://bootstrapmade.com/content/demo/NiceAdmin/components-breadcrumbs.html">
                         <i class="bi bi-circle"></i><span>Breadcrumbs</span>
                     </a>
                 </li>
                 <li>
                     <a href="https://bootstrapmade.com/content/demo/NiceAdmin/components-buttons.html">
                         <i class="bi bi-circle"></i><span>Buttons</span>
                     </a>
                 </li>
                 <li>
                     <a href="https://bootstrapmade.com/content/demo/NiceAdmin/components-cards.html">
                         <i class="bi bi-circle"></i><span>Cards</span>
                     </a>
                 </li>
                 <li>
                     <a href="https://bootstrapmade.com/content/demo/NiceAdmin/components-carousel.html">
                         <i class="bi bi-circle"></i><span>Carousel</span>
                     </a>
                 </li>
                 <li>
                     <a href="https://bootstrapmade.com/content/demo/NiceAdmin/components-list-group.html">
                         <i class="bi bi-circle"></i><span>List group</span>
                     </a>
                 </li>
                 <li>
                     <a href="https://bootstrapmade.com/content/demo/NiceAdmin/components-modal.html">
                         <i class="bi bi-circle"></i><span>Modal</span>
                     </a>
                 </li>
                 <li>
                     <a href="https://bootstrapmade.com/content/demo/NiceAdmin/components-tabs.html">
                         <i class="bi bi-circle"></i><span>Tabs</span>
                     </a>
                 </li>
                 <li>
                     <a href="https://bootstrapmade.com/content/demo/NiceAdmin/components-pagination.html">
                         <i class="bi bi-circle"></i><span>Pagination</span>
                     </a>
                 </li>
                 <li>
                     <a href="https://bootstrapmade.com/content/demo/NiceAdmin/components-progress.html">
                         <i class="bi bi-circle"></i><span>Progress</span>
                     </a>
                 </li>
                 <li>
                     <a href="https://bootstrapmade.com/content/demo/NiceAdmin/components-spinners.html">
                         <i class="bi bi-circle"></i><span>Spinners</span>
                     </a>
                 </li>
                 <li>
                     <a href="https://bootstrapmade.com/content/demo/NiceAdmin/components-tooltips.html">
                         <i class="bi bi-circle"></i><span>Tooltips</span>
                     </a>
                 </li>
             </ul>
         </li><!-- End Components Nav -->


         <li class="nav-heading">Pages</li>



         <li class="nav-item">
             <a class="nav-link collapsed" href="">
                 <i class="bi bi-file-earmark"></i>
                 <span>Blank</span>
             </a>
         </li><!-- End Blank Page Nav -->

     </ul>

 </aside>
