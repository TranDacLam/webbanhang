<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="source/assets/admin/img/avatar5.png" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>Trần Lâm</p>
      </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
      </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MENU</li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-bar-chart"></i> 
          <span>Thống kê</span>
        </a>
      </li>
      <li class="treeview">
        <a href="{!! route('getListUser') !!}">
          <i class="fa fa-user"></i>
          <span>Thành viên</span>
        </a>
      </li>
      <li class="treeview">
        <a href="{!! route('getListCate') !!}">
          <i class="fa fa-th-list"></i>
          <span>Thể loại</span>
        </a>
      </li>
      <li class="treeview">
        <a href="{!! route('getListProduct') !!}">
          <i class="fa fa-cutlery"></i>
          <span>Sản phẩm</span>
        </a>
      </li>
      <li class="treeview">
        <a href="{!! route('getIndexOrder') !!}">
          <i class="fa fa-shopping-cart"></i>
          <span>Đơn đặt hàng</span>
        </a>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-question-circle"></i>
          <span>Sản phẩm đề xuất</span>
        </a>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-commenting"></i>
          <span>Phản hồi</span>
        </a>
      </li>
    </ul>
  </section>
</aside>