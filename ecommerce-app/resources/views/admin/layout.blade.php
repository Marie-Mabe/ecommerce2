<!DOCTYPE html>
<html lang="fr">
<head>
    @include('admin.produits.partials.head')  <!-- Inclure le partial head -->
</head>
<body>
  <div class="container-scroller">
    @include('admin.produits.partials.navbar')
    
    <div class="container-fluid page-body-wrapper">
      @include('admin.produits.partials.sidebar')
      
      <div class="main-panel">
        <div class="content-wrapper">
          @yield('content')
        </div>
        @include('admin.produits.partials.footer')
      </div>
    </div>
  </div>

  @include('admin.produits.partials.scripts')  <!-- Inclure les scripts -->
  @yield('scripts')  <!-- Pour les scripts personnalisés -->
</body>
</html>