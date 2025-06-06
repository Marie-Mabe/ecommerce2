<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="E-Market">
  <link rel="shortcut icon" href="{{ asset('favicon.png') }}">

  <meta name="description" content="Boutique en ligne E-Market" />
  <meta name="keywords" content="ecommerce, boutique en ligne, achats" />

  <!-- Bootstrap CSS -->
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="{{ asset('css/tiny-slider.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  
  <style>
    :root {
      --primary-color: #2c3e50;
      --secondary-color: #3498db;
      --accent-color: #e74c3c;
      --light-color: #ecf0f1;
      --dark-color: #2c3e50;
    }
    
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8f9fa;
      color: #333;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    
    /* Navigation */
    .custom-navbar {
      background-color: var(--primary-color) !important;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      padding: 15px 0;
    }
    
    .navbar-brand {
      font-weight: 700;
      font-size: 1.8rem;
      color: white !important;
    }
    
    .navbar-brand span {
      color: var(--secondary-color);
    }
    
    .custom-navbar-nav .nav-link {
      color: white !important;
      font-weight: 500;
      padding: 8px 15px;
      margin: 0 5px;
      border-radius: 4px;
      transition: all 0.3s ease;
    }
    
    .custom-navbar-nav .nav-link:hover,
    .custom-navbar-nav .active .nav-link {
      background-color: rgba(255,255,255,0.1);
      color: var(--secondary-color) !important;
    }
    
    .custom-navbar-cta .nav-link {
      padding: 8px;
      margin-left: 10px;
    }
    
    .custom-navbar-cta img {
      width: 24px;
      height: 24px;
      transition: transform 0.3s ease;
    }
    
    .custom-navbar-cta .nav-link:hover img {
      transform: scale(1.1);
    }
    
    /* Dropdown menu styles */
    .dropdown-menu {
      border: none;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .dropdown-item {
      padding: 8px 16px;
      transition: all 0.2s;
    }
    
    .dropdown-item:hover {
      background-color: #f8f9fa;
      color: var(--secondary-color);
    }
    
    /* Main content */
    main {
      flex: 1;
      padding: 30px 0;
    }
    
    /* Footer */
    .site-footer {
      background-color: var(--dark-color);
      color: white;
      padding: 40px 0;
    }
    
    /* Boutons */
    .btn-primary {
      background-color: var(--secondary-color);
      border-color: var(--secondary-color);
    }
    
    .btn-primary:hover {
      background-color: #2980b9;
      border-color: #2980b9;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
      .navbar-brand {
        font-size: 1.5rem;
      }
      
      .custom-navbar-nav {
        margin-top: 15px;
      }
      
      .custom-navbar-cta {
        margin-top: 15px;
        padding-left: 0;
      }
      
      .dropdown-menu {
        position: static;
        float: none;
      }
    }
  </style>
  
  <title>E-Market - @yield('title', 'Boutique en ligne')</title>
</head>
<body>

  <!-- Start Header/Navigation -->
  <nav class="custom-navbar navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Navigation principale">
    <div class="container">
      <a class="navbar-brand" href="{{ route('user.shop') }}">E-Market<span>.</span></a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="mainNavbar">
        <ul class="custom-navbar-nav navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item {{ request()->routeIs('user.shop') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user.shop') }}">Accueil</a>
          </li>
          <li class="nav-item {{ request()->routeIs('user.about') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user.about') }}">À propos</a>
          </li>
          <li class="nav-item {{ request()->routeIs('user.contact') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user.contact') }}">Contact</a>
          </li>
        </ul>

        <ul class="custom-navbar-cta navbar-nav mb-2 mb-lg-0">
          @auth
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="Mon compte">
              <i class="fas fa-user fa-lg"></i>
              <span class="d-none d-lg-inline ms-1">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
              <li><a class="dropdown-item" href="{{ route('user.profile') }}"><i class="fas fa-user-circle me-2"></i>Mon profil</a></li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="dropdown-item" style="width: 100%; text-align: left;">
                    <i class="fas fa-sign-out-alt me-2"></i>Déconnexion
                  </button>
                </form>
              </li>
            </ul>
          </li>
          @endauth
          <li class="nav-item">
            <a class="nav-link position-relative" href="{{ route('user.cart') }}" title="Panier">
              <i class="fas fa-shopping-cart fa-lg"></i>
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                {{ Cart::getTotalQuantity() }}
                <span class="visually-hidden">articles dans le panier</span>
              </span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Header/Navigation -->

  <main class="container">
    @yield('content')
  </main>

  <!-- Footer -->
  @include('user.navigation.footer')

  <!-- Scripts -->
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('js/tiny-slider.js') }}"></script>
  <script src="{{ asset('js/custom.js') }}"></script>
  
  <!-- Script pour initialiser les dropdowns -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Initialisation des dropdowns Bootstrap
      var dropdownTriggers = [].slice.call(document.querySelectorAll('[data-bs-toggle="dropdown"]'));
      dropdownTriggers.forEach(function (trigger) {
        trigger.addEventListener('click', function (e) {
          e.preventDefault();
          var dropdown = new bootstrap.Dropdown(trigger);
          dropdown.toggle();
        });
      });
    });
  </script>
  
  @yield('scripts')

</body>
</html>