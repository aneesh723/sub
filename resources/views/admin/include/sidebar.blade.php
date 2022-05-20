<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="#">
         <span class="logo-name">Home</span>
        </a>
      </div>
      <ul class="sidebar-menu">
        <li class="dropdown">
          <a href="{{ route('admin.dashboard') }}" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
        </li>
        <li class="dropdown">
          <a href="{{ route('admin.subs') }}" class="nav-link"><i data-feather="monitor"></i><span>Subcriptions</span></a>
        </li>
        <li class="dropdown">
          <a href="{{ route('admin.logout') }}" class="nav-link">Logout</a>
        </li>

      </ul>
    </aside>
  </div>