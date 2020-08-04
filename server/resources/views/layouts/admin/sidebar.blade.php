<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
  <div class="scrollbar-inner">
    <!-- Brand -->
    <div class="sidenav-header d-flex align-items-center">
      <a class="navbar-brand" href="{{ route('admin.dashboard')}}">
        {{ (!empty(config('app.name')) ? config('app.name') : 'Ikada Dashboard') }}
      </a>
      <div class="ml-auto">
        <!-- Sidenav toggler -->
        <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
          <div class="sidenav-toggler-inner">
            <i class="sidenav-toggler-line"></i>
            <i class="sidenav-toggler-line"></i>
            <i class="sidenav-toggler-line"></i>
          </div>
        </div>
      </div>
    </div>
    <div class="navbar-inner">
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Nav items -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="{{ route('admin.dashboard')}}" class="nav-link {{ !empty($menu) ? ($menu == "dashboard" ? 'active' : '') : '' }}">
              <i class="ni ni-shop text-primary"></i>
              <span class="nav-link-text">Dashboard</span>
            </a>
          </li> 

          @if(Auth::guard('employee')->user()->can('admin-list') || Auth::guard('employee')->user()->can('roles-list'))
            <li class="nav-item">
              <a class="nav-link {{ !empty($menu) ? ($menu == "accounts" ? 'active' : '') : '' }}" href="#navbar-accounts" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-accounts">
                <i class="ni ni-circle-08 text-primary"></i>
                <span class="nav-link-text">Accounts</span>
              </a>
              <div class="collapse {{ !empty($menu) ? ($menu == "accounts" ? 'show' : '') : '' }}" id="navbar-accounts">
                <ul class="nav nav-sm flex-column">
                  @if(Auth::guard('employee')->user()->can('admin-list'))
                    <li class="nav-item {{ !empty($submenu) ? ($submenu == 'admins' ? 'show' : '') : '' }}">
                      <a href="{{ route('admin.admin.index')}}" class="nav-link">Admin</a>
                    </li>
                  @endif
                  
                  @if(Auth::guard('employee')->user()->can('roles-list'))
                    <li class="nav-item {{ !empty($submenu) ? ($submenu == 'roles' ? 'show' : '') : '' }}">
                      <a href="{{ route('admin.role.index') }}" class="nav-link">Role</a>
                    </li>
                  @endif
                </ul>
              </div>
            </li>
          @endif

          @if( Auth::guard('employee')->user()->can('category-list') )
          <li class="nav-item">
            <a class="nav-link {{ !empty($menu) ? ($menu == "categories" ? 'active' : '') : '' }}" href="#navbar-categories" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-categories">
              <i class="ni ni-bullet-list-67 text-primary"></i>
              <span class="nav-link-text">Category</span>
            </a>
            <div class="collapse {{ !empty($menu) ? ($menu == "categories" ? 'show' : '') : '' }}" id="navbar-categories">
              <ul class="nav nav-sm flex-column">
                @if(Auth::guard('employee')->user()->can('category-list'))
                  <li class="nav-item {{ !empty($submenu) ? ($submenu == 'category' ? 'show' : '') : '' }}">
                    <a href="{{ route('admin.category.index')}}" class="nav-link">Category</a>
                  </li>
                @endif
              </ul>
            </div>
          </li>
          @endif
        </ul>
        <!-- Divider -->
        <hr class="my-3">
        <!-- Heading -->
        <h6 class="navbar-heading p-0 text-muted">Repository</h6>
        <!-- Navigation -->
        <ul class="navbar-nav mb-md-3">
          <li class="nav-item">
            <a class="nav-link" href="https://github.com/claytten/jalimbing_app" target="_blank">
              <i class="ni ni-collection"></i>
              <span class="nav-link-text">Claytten</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>