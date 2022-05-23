<nav class="main-header navbar wrap navbar-expand navbar-white navbar-light principal-color">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" data-bs-toggle="tooltip" data-bs-placement="left" title="Menú"></i></a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      
      <li class="nav-item">
        <div class="dropdown">
          <i class="fas fa-sign-in-alt" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false" title="Cerrar sesion"></i>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a href="#" class="dropdown-item"onclick="document.getElementById('logout-form').submit()">Cerrar sesión</a>
          </div>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
      </li>
    </ul>
</nav>