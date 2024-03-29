<aside class="main-sidebar sidebar-dark-primary elevation-4 principal-color">
    <!-- Brand Logo -->
    <a href="{{route('dashboard.index')}}" class="brand-link" data-bs-toggle="tooltip" data-bs-placement="left" title="Inicio">
      <img src="{{url('/')}}/adminLTE/img/logo.png" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">BeautySoft</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition"><div class="os-resize-observer-host observed"><div class="os-resize-observer" style="left: 0px; right: auto;"></div></div><div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;"><div class="os-resize-observer"></div></div><div class="os-content-glue" style="margin: 0px -8px; width: 249px; height: 567px;"></div><div class="os-padding"><div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;"><div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <a href="{{route("usuarios.perfil")}}">
          </a>
        </div>
        <div class="info">
          <a href="{{route("usuarios.perfil")}}" class="d-block" data-bs-toggle="tooltip" data-bs-placement="left" title="Ver mi perfil">
            @guest
            @else  
              {{ Auth::user()->name }}  
            @endguest  
          </a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{route('dashboard.index')}}" class="nav-link" data-bs-toggle="tooltip" data-bs-placement="left" title="Ir a informes">
              <i class="fas fa-chart-bar"></i>
              <p>
                Inicio
              </p>
            </a>
          </li> 
          @if (Auth::user()->rol_id == 1)
            <li class="nav-item">
              <a href="{{route('roles.index')}}" class="nav-link" data-bs-toggle="tooltip" data-bs-placement="left" title="Ir a información de roles">
                <i class="fas fa-user-lock"></i>
                <p>
                  Roles
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('usuarios.index')}}" class="nav-link" data-bs-toggle="tooltip" data-bs-placement="left" title="Ir a información de usuarios">
                <i class="fas fa-users"></i>
                <p>
                  Usuarios
                </p>
              </a>
            </li>
          @endif
          
          <li class="nav-item">
            <a href="#" class="nav-link" data-bs-toggle="tooltip" data-bs-placement="left" title="Desplegar menú productos">
              <i class="fab fa-product-hunt"></i>
              <p>
                Productos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('productos.index')}}" class="nav-link" data-bs-toggle="tooltip" data-bs-placement="left" title="Ir a información de productos">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Productos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('servicios.index')}}" class="nav-link" data-bs-toggle="tooltip" data-bs-placement="left" title="Ir a información de servicios">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Servicios</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('existencias.index')}}" class="nav-link" data-bs-toggle="tooltip" data-bs-placement="left" title="Ir a información de existencias">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Existencias</p>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link" data-bs-toggle="tooltip" data-bs-placement="left" title="Desplegar menú de compras">
              <i class="fas fa-shopping-cart"></i>
              <p>
                Compras
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{route('compras.index')}}" class="nav-link" data-bs-toggle="tooltip" data-bs-placement="left" title="Ir a información de compras">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Compras</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('proveedores.index')}}" class="nav-link" data-bs-toggle="tooltip" data-bs-placement="left" title="Ir a información de proveedores">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Proveedores</p>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="{{route('agenda.index')}}" class="nav-link" data-bs-toggle="tooltip" data-bs-placement="left" title="Abrir agenda">
              <i class="fas fa-money-check"></i>
              <p>
                Agenda
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link" data-bs-toggle="tooltip" data-bs-placement="left" title="Desplegar menú de ventas">
              <i class="fas fa-tags"></i>
              <p>
                Ventas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('clientes.index')}}" class="nav-link" data-bs-toggle="tooltip" data-bs-placement="left" title="Ir a información de clientes">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Clientes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('ventas.index')}}" class="nav-link" data-bs-toggle="tooltip" data-bs-placement="left" title="Ir a información de ventas">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ventas</p>
                </a>
              </li>
            </ul>
          </li>
          
         
        </ul>
      </nav>
    </div></div></div><div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden"><div class="os-scrollbar-track"><div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div></div></div><div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden"><div class="os-scrollbar-track"><div class="os-scrollbar-handle" style="height: 41.7954%; transform: translate(0px, 0px);"></div></div></div><div class="os-scrollbar-corner"></div></div>
</aside>