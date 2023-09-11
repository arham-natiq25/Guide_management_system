<nav class="main-header navbar navbar-expand navbar-primary navbar-light ">
    <!-- Left navbar links -->
    <ul class="navbar-nav ">
      <li class="nav-item">
        <a class="nav-link text-white" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      @if (Auth::user()->isAdmin())
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('reservations.home') }}" class="nav-link text-white"><h6>Reservation</h6>
        </a>
      </li>
      @elseif(Auth::user()->isGuide())
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('guide.reservations') }}" class="nav-link text-white"><h6>Reservation</h6>
        </a>
      </li>
      @elseif(Auth::user()->isCustomer())
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('customer.reservations') }}" class="nav-link text-white"><h6>Reservation</h6>
        </a>
      </li>
      @endif


      @if (Auth::user()->isAdmin())
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('calendar.index') }}" class="nav-link text-white"><h6>Calender</h6>
        </a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link text-white"><h6>Customer</h6>
        </a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link text-white"><h6>Reports</h6>
        </a>
      </li>
      @endif
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
     <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link text-white" data-toggle="dropdown" href="#">
            <i class="fas fa-user-circle"></i><span> {{ Auth::user()->name }}</span>

        </a>
        <div class="dropdown-menu ">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                  <a href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                      this.closest('form').submit();" class="btn btn-danger btn-block"><i class="fas fa-sign-out-alt"></i> Log out</a>
              </form>
        </div>
       </li>

    </ul>
  </nav>
