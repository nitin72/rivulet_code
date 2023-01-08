<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="javascript:void(0)" class="brand-link">
    <img src="{{url('resources/assets/admin/img/AdminLTELogo.png')}}"
         alt="Company Logo"
         class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light">Post</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
   
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="{{url('admin/post')}}" class="nav-link">
            <i class="nav-icon fas fa-venus-double"></i>
            <p>
              Post
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{url('admin/category')}}" class="nav-link">
            <i class="nav-icon fas fa-venus-double"></i>
            <p>
              Category
            </p>
          </a>
        </li>


      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>