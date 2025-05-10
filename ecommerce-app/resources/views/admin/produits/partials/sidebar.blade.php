<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    
    <!-- Menu Produits -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.produits.index') }}">
        <i class="icon-box menu-icon"></i>
        <span class="menu-title">Produits</span>
      </a>
    </li>

    <!-- Menu Catégories -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.categories.index') }}">
        <i class="icon-layout menu-icon"></i>
        <span class="menu-title">Catégories</span>
      </a>
    </li>

    <!-- Menu Gestion des stocks -->
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#stock" aria-expanded="false" aria-controls="stock">
        <i class="icon-bar-graph menu-icon"></i>
        <span class="menu-title">Gestion des stocks</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="stock">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.stock.dashboard') }}">Tableau de bord</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.stock.index') }}">État des stocks</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.stock.alerte') }}">Alertes</a>
          </li>
        </ul>
      </div>
    </li>

    <!-- Menu Fournisseurs -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.fournisseurs.index') }}">
        <i class="ti-truck menu-icon"></i>
        <span class="menu-title">Fournisseurs</span>
      </a>
    </li>
  </ul>
</nav>