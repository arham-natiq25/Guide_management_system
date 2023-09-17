<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    @if (Auth::user()->isAdmin())
    <a href="{{ route('admin.dashboard') }}" class="brand-link bg-primary text-center">
      <span class="brand-text  font-weight-light">Guide Management</span>
    </a>
    @elseif(Auth::user()->isGuide())
    <a href="{{ route('guide.dashboard') }}" class="brand-link bg-primary text-center">
      <span class="brand-text  font-weight-light">Guide Management</span>
    </a>
    @elseif(Auth::user()->isCustomer())
    <a href="{{ route('customer.dashboard') }}" class="brand-link bg-primary text-center">
      <span class="brand-text  font-weight-light">Guide Management</span>
    </a>
    @endif
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-2 pb-2 mb-1 d-flex ">
        <div class="image h1 mt-2 font-weight-bold">
            <i class="fas fa-user-circle"></i>
        </div>
        <div class="info">
          <a href="#" class="d-block text-white">{{ Auth::user()->name }}</a>
          <p class="text-white text-sm"><i class="fas fa-circle text-success text-sm"></i> online</p>
        </div>

      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline text-center">
        <div class="input-group ">
          <h4> MAIN MENU </h4>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          {{-- <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.html" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index2.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v3</p>
                </a>
              </li>
            </ul>
          </li> --}}

          {{-- Dashboard --}}
          @if(Auth::user()->isAdmin())
          <li class="nav-item">
              <a href="{{ route('admin.dashboard') }}" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                      Dashboard
                    </p>
                </a>
          </li>
          @elseif(Auth::user()->isGuide())
          <li class="nav-item">
              <a href="{{ route('guide.dashboard') }}" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                      Dashboard
                    </p>
                </a>
          </li>
          @elseif(Auth::user()->isCustomer())
          <li class="nav-item">
              <a href="{{ route('customer.dashboard') }}" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                      Dashboard
                    </p>
                </a>
          </li>
          @endif

          {{-- setup  --}}
     @if(Auth::user()->isAdmin())

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon far fa-copy"></i>
                <p>
                  Setup
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('guides.index') }}" class="nav-link">
                    <p>Guides</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('trips.index') }}" class="nav-link">
                    <p>Trips</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('rivers.index') }}" class="nav-link">
                    <p>Rivers</p>
                  </a>
                </li>
                <li class="nav-item">
                    <a href="./index.html" class="nav-link">
                      <p>Entry / Exit</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('agencies.index') }}" class="nav-link">
                      <p>Agencies</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('locations.index') }}" class="nav-link">
                      <p>Location</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./index.html" class="nav-link">
                      <p>Shuttles</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('coupons.index') }}" class="nav-link">
                      <p>Coupons</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./index.html" class="nav-link">
                      <p>Referrals</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('email.index')}}" class="nav-link">
                      <p>Email / Text templets</p>
                    </a>
                </li>

              </ul>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon far fa-copy"></i>
                <p>
                  Servey
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="./index.html" class="nav-link">
                    <p> v1</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon far fa-copy"></i>
                <p>
                  Class setup
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="./index.html" class="nav-link">
                    <p> v1</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon far fa-copy"></i>
                <p>
                  CMS page
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="./index.html" class="nav-link">
                    <p> v1</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon far fa-copy"></i>
                <p>
                  Pre-trip Questionire
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="./index.html" class="nav-link">
                    <p> v1</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon far fa-copy"></i>
                <p>
                  Book Me
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="./index.html" class="nav-link">
                    <p> v1</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon far fa-copy"></i>
                <p>
                  Lunch
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="./index.html" class="nav-link">
                    <p> v1</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="{{ route('settings.index') }}" class="nav-link">
                <i class="nav-icon fas fa-tools"></i>
                <p>
                  Setting
                </p>
              </a>
            </li>
       @endif
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                 @csrf
               <a  href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                 this.closest('form').submit();" class="nav-link">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                  <p>
                    Log out
                </p>
               </a>
              </form>

            </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
