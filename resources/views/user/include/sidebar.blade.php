<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="#">
         <span class="logo-name">Home</span>
        </a>
      </div>
      <ul class="sidebar-menu">
        <li class="dropdown">
          <a href="{{ url('/dashboard') }}" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
        </li>
        <li class="dropdown">
          <a href="{{ route('user.customer') }}" class="nav-link"><i data-feather="user"></i><span>Customer</span></a>
        </li>
        <li class="dropdown">
          <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <a href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">Log Out
                    </a>
                </form>
            </div>
        </li>

      </ul>
    </aside>
  </div>