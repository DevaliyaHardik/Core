  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="skin/admin/assets/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="skin/admin/assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">QuestCom</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="skin/admin/assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Hardik Devaliya</a>
        </div>
      </div>

      <?php if($this->getLoginStatus()): ?>
      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?php echo $this->getUrl('index','admin',[],true)?>" class="nav-link">
              <i class="right fa-solid fa-user"></i>
              <p>Admin</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo $this->getUrl('index','cart',[],true)?>" class="nav-link">
              <i class="right fa-solid fa-cart-shopping"></i>
              <p>Cart</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo $this->getUrl('index','category',[],true)?>" class="nav-link">
              <i class="right fa-solid fa-boxes-packing"></i>
              <p>Category</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo $this->getUrl('index','config',[],true)?>" class="nav-link">
              <i class="right fa-solid fa-th"></i>
              <p>Config</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo $this->getUrl('index','customer',[],true)?>" class="nav-link">
              <i class="right fa-solid fa-users"></i>
              <p>Customer</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo $this->getUrl('index','page',[],true)?>" class="nav-link">
              <i class="right fa-solid fa-file-lines"></i>
              <p>Page</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo $this->getUrl('index','product',[],true)?>" class="nav-link">
              <i class="right fa-solid fa-people-arrows-left-right"></i>
              <p>Product</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo $this->getUrl('index','salesman',[],true)?>" class="nav-link">
              <i class="right fa-solid fa-people-arrows-left-right"></i>
              <p>Salesman</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo $this->getUrl('index','vendor',[],true)?>" class="nav-link">
              <i class="right fa-solid fa-people-carry-box"></i>
              <p>Vendor</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo $this->getUrl('logout','admin_login',[],true)?>" class="nav-link">
              <i class="right fa-solid fa-right-from-bracket"></i>
              <p>Logout</p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <?php endif;?>
    <!-- /.sidebar -->
  </aside>
