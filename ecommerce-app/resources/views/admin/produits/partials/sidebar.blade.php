<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    
    <!-- Menu Produits à ajouter ici -->
    <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.produits.index') }}">
        <i class="icon-box menu-icon"></i>
        <span class="menu-title">Produits</span>
      </a>
    </li>

    <!-- Exemple de menu déroulant -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.categories.index') }}">
        <i class="icon-layout menu-icon"></i>
        <span class="menu-title">Catégories</span>
       
      </a>
      
    </li>

    <!-- Autres éléments du menu... -->
  </ul>
</nav>