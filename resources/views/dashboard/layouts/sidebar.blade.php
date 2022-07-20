<nav class="sidebar sidebar-offcanvas" id="sidebar">
    
    <ul class="nav">
      @can('user')
      <li class="nav-item">
        <a class="nav-link {{ Request::is('/dashboard') ? 'active' : '' }}" href="{{ url('/dashboard') }}">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>     
      <li class="nav-item">
        <a class="nav-link {{ Request::is('/qrcode*') ? 'active' : '' }}" href="{{ url('/qrcode') }}">
          <i class="icon-paper menu-icon"></i>
          <span class="menu-title">QR-Code</span>
        </a>
      </li>
      @endcan

      @can('admin')
      <li class="nav-item">
        <a class="nav-link {{ Request::is('/admin*') ? 'active' : '' }}" href="{{ url('/admin') }}">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('/users*') ? 'active' : '' }}" href="{{ url('/users') }}">
          <i class="icon-head menu-icon"></i>
          <span class="menu-title">Users</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('/kategori*') ? 'active' : '' }}" href="{{ url('/kategori') }}">
          <i class="icon-align-right menu-icon"></i>
          <span class="menu-title">Kategori</span>
        </a>
      </li>
      @endcan
    </ul>

  </nav>