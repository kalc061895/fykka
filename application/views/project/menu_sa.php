<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="<?php echo site_url('sistema');?>"><i class="fa fa-laptop-code"></i> Fykka</a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" >
        <div class="input-group" >
          <input type="text" class="form-control" placeholder="Busca amigos..." aria-label="Search" aria-describedby="basic-addon2" >
          <div class="input-group-append">
            <button class="btn btn-primary" type="button">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>
      
      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">
      <!-- 
        
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bell fa-fw"></i>
            <span class="badge badge-danger">9+</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-envelope fa-fw"></i>
            <span class="badge badge-danger">7</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
      Navbar -->
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="#"><?php echo $this->session->userdata("datos");?></a>
            <a class="dropdown-item opcion" href="<?php echo site_url('sistema/perfil');?>"> <i class="fa fa-user"></i> Mi perfil</a>
            <a class="dropdown-item opcion" href="<?php echo site_url('sistema/notificaciones');?>"><i class="fas fa-cogs "></i> Configuraciones</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal"><i class="fa fa-power-off"></i> Salir</a>
           </div>
        </li>
        <!-- *************************** -->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
	      <div class="modal-dialog" role="document">
	        <div class="modal-content">
	          <div class="modal-header">
	            <h5 class="modal-title" id="exampleModalLabel">¿Estás seguro?</h5>
	            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
	              <span aria-hidden="true">×</span>
	            </button>
	          </div>
	          <div class="modal-body">Si estás seguro de cerrar sesión presiona "Salir" aquí abajo, si no presiona cancelar</div>
	          <div class="modal-footer">
	            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
	            <a class="btn btn-primary" href="<?php echo site_url('sistema/cerrar_session');?>">Salir</a>
	          </div>
	        </div>
	      </div>
	    </div>
        <!-- *************************** -->
      </ul>

    </nav>

    <div id="wrapper">

      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo site_url(''); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Principal</span>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Proyectos</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Login Screens:</h6>
            <a class="dropdown-item" href="login.html">Login</a>
            <a class="dropdown-item" href="register.html">Register</a>
            <a class="dropdown-item" href="forgot-password.html">Forgot Password</a>
            <div class="dropdown-divider"></div>
            <h6 class="dropdown-header">Other Pages:</h6>
            <a class="dropdown-item" href="404.html">404 Page</a>
            <a class="dropdown-item active" href="blank.html">Blank Page</a>
          </div>
        </li>

        <?php if (isset($menu)): ?>
          
            <?php foreach ($menu as $row): ?>
              <?php if ($row->menu=='principal'): ?>
                
              <?php endif ?>
              <?php if ($row->menu=='menu'): ?>
                
              <?php endif ?>
              <?php if ($row->menu=='perfil'): ?>
                
              <?php endif ?>

              <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Proyectos</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Login Screens:</h6>
            <a class="dropdown-item" href="login.html">Login</a>
            <a class="dropdown-item" href="register.html">Register</a>
            <a class="dropdown-item" href="forgot-password.html">Forgot Password</a>
            <div class="dropdown-divider"></div>
            <h6 class="dropdown-header">Other Pages:</h6>
            <a class="dropdown-item" href="404.html">404 Page</a>
            <a class="dropdown-item active" href="blank.html">Blank Page</a>
          </div>
        </li>
            <?php endforeach ?>  

        <?php endif ?>
        
        <li class="nav-item">
          <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-tasks"></i>
            <span>Mis Tareas</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-user-tie"></i>
            <span>Mi Perfil</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link opcion" href="<?php echo site_url('social/friends'); ?>">
            <i class="fas fa-fw fa-users"></i>
            <span>Mis amigos</span></a>
        </li>
        <li class="nav-item">
        	<div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <?php print_r($menu); ?>
                    <li class="" >
                        <a href="<?php echo site_url('sistema'); ?>"><i class="fa fa-home"></i> Inicio</a>
                    </li>
                    <?php if ($menu!=null): ?>
                        <?php 
                            $class=$class1=$class2=$class3='hidden';
                            foreach ($menu as $row) {
                                if ($row->role_tipo=='proyectos'){ $class1='';}
                                if ($row->role_tipo=='TAREAS'){ $class='';}
                                if ($row->role_tipo=='OTROS'){ $class2='';}
                                if ($row->role_tipo=='MAPAS'){ $class3='';}
                            }

                         ?>
                        <li class="<?php echo $class;?>">
                        <a href="#" data-toggle="collapse" data-target="#TAREAS"><i class="fa fa-gears"></i> TAREAS <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="TAREAS" class="collapse">
                            <?php foreach ($menu as $row): ?>
                                
                                <?php if ($row->role_tipo == "TAREAS"): ?>
                                    <li>
                                    <a class="opcion" href="<?php echo $row->role_link;?>"><i class="fa fa-<?php echo $row->role_icon;?>"></i> <?php echo $row->role_nombre;?></a>
                                    </li>
                                <?php endif ?>
                                
                            <?php endforeach ?>
                        </ul>
                    </li>

                    <li class="<?php echo $class1;?>">
                        <a href="#" data-toggle="collapse" data-target="#proyectos"><i class="fa fa-pie-chart"></i> GESTIÓN <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="proyectos" class="collapse">
                            <?php foreach ($menu as $row): ?>
                                
                                <?php if ($row->role_tipo == "proyectos"): ?>
                                    <li>
                                    <a class="opcion" href="<?php echo $row->role_link;?>"><i class="fa fa-<?php echo $row->role_icon;?>"></i> <?php echo $row->role_nombre;?></a>
                                    </li>
                                <?php endif ?>
                            <?php endforeach ?>
                        </ul>
                    </li>
                    
                    <li class="<?php echo $class2;?>">
                        <a href="#" data-toggle="collapse" data-target="#OTROS"><i class="fa fa-bar-chart"></i> OTROS <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="OTROS" class="collapse">
                            <?php foreach ($menu as $row): ?>
                                
                                <?php if ($row->role_tipo == "OTROS"): ?>
                                    <li>
                                    <a class="opcion" href="<?php echo $row->role_link;?>"><i class="fa fa-<?php echo $row->role_icon;?>"></i> <?php echo $row->role_nombre;?></a>
                                    </li>
                                <?php endif ?>
                            <?php endforeach ?>
                        </ul>
                    </li>
                    <li class="<?php echo $class3;?>">
                        <a href="#" data-toggle="collapse" data-target="#mapas"><i class="fa fa-truck"></i> MAPAS <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="mapas" class="collapse">
                            <?php foreach ($menu as $row): ?>
                                
                                <?php if ($row->role_tipo == "MAPAS"): ?>
                                    <li>
                                    <a class="opcion" href="<?php echo $row->role_link;?>"><i class="fa fa-<?php echo $row->role_icon;?>"></i> <?php echo $row->role_nombre;?></a>
                                    </li>
                                <?php endif ?>
                            <?php endforeach ?>
                        </ul>
                    </li>
                    <?php endif ?>
                </ul>
            </div>
        </li>
      </ul>

      <div id="content-wrapper">
			<div class="container-fluid" id="body_main">

        

            
