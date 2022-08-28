 <!-- Preloader -->
 <div class="preloader flex-column justify-content-center align-items-center">
     <img class="animation__shake" src="{{ asset('asset/admin') }}/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60"
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
                 <img src="{{ asset(Auth::guard('admin')->user()->path_image) }}"
                     class="user-image img-circle elevation-2" alt="User Image">
                 <span class="d-none d-md-inline">{{ ucfirst(Auth::guard('admin')->user()->name) }}</span>
             </a>
             <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                 <!-- User image -->
                 <li class="user-header bg-primary">
                     <img src="{{ asset(Auth::guard('admin')->user()->path_image) }}" class="img-circle elevation-2"
                         alt="User Image">
                     <p>
                         {{ ucfirst(Auth::guard('admin')->user()->name) }}
                         <small>{{ ucfirst(Auth::guard('admin')->user()->role->name) }}</small>
                     </p>
                 </li>
                 <!-- Menu Footer-->
                 <li class="user-footer">
                     <a href="{{route('user.show', Auth::guard('admin')->user()->id)}}" class="btn btn-sm btn-success">
                         <i class="fas fa-info-circle"></i>
                         Profile
                     </a>
                     <a href="{{ route('admin.logout') }}" class="btn btn-sm btn-success float-right">
                         <i class="fas fa-sign-out-alt"></i>
                         Logout
                     </a>
                 </li>
             </ul>
         </li>
     </ul>
 </nav>
 <!-- /.navbar -->
