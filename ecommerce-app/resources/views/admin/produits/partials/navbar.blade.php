<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
    <a class="navbar-brand brand-logo mr-5" href="#">
      <span class="text-orange-500 font-bold text-xl">E-Market</span>
    </a>
    <a class="navbar-brand brand-logo-mini" href="#">
      <span class="text-orange-500 font-bold">E-M</span>
    </a>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="icon-menu text-orange-500"></span>
    </button>
    
    <ul class="navbar-nav navbar-nav-right">
      <li class="nav-item dropdown">
        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
          <i class="icon-bell mx-0 text-orange-500"></i>
        </a>
        <!-- Dropdown notifications -->
      </li>
      <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
          <img src="{{ asset('assets/images/faces/face28.jpg') }}" alt="profile"/>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
          <a class="dropdown-item">
            <i class="ti-settings text-orange-500"></i>
            Paramètres
          </a>
          <a class="dropdown-item">
            <i class="ti-power-off text-orange-500"></i>
            Déconnexion
          </a>
        </div>
      </li>
    </ul>
  </div>
</nav>