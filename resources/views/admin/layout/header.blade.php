 <!-- Preloader -->
 <div class="preloader flex-column justify-content-center align-items-center">
     <img class="animation__shake" src="{{ asset('admin') }}/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60"
         width="60">
 </div>

 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-primary navbar-dark">
     <!-- Left navbar links -->
     <ul class="navbar-nav">
         <li class="nav-item">
             <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
         </li>
     </ul>

     <!-- Right navbar links -->
     <ul class="navbar-nav ml-auto">

         <!-- Messages Dropdown Menu -->
         <li class="nav-item dropdown user-menu">
             <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                 <img src="{{ asset('admin') }}/dist/img/user2-160x160.jpg" class="user-image img-circle elevation-2"
                     alt="User Image">
                 <span class="d-none d-md-inline">Alexander Pierce</span>
             </a>
             <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                 <!-- User image -->
                 <li class="user-header bg-primary">
                     <img src="{{ asset('admin') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                         alt="User Image">
                     <p>
                         Alexander Pierce - Web Developer
                         <small>Member since Nov. 2012</small>
                     </p>
                 </li>
                 <!-- Menu Footer-->
                 <li class="user-footer">
                     <a href="#" class="btn btn-sm btn-success">Profile</a>
                     <a href="#" class="btn btn-sm btn-success float-right">Sign out</a>
                 </li>
             </ul>
         </li>
     </ul>
 </nav>
 <!-- /.navbar -->
