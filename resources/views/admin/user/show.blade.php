@extends('admin.layout.main')
@section('contents')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href="{{route('user.index')}}" class="float-left btn btn-lm btn-warning">
                            <i class="fas fa-list-alt"></i>
                            Danh sách
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">User</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row ">
                    <div class="col d-flex justify-content-center">
                        <div class="col-md-6">
                            <!-- Profile Image -->
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle"
                                            src="{{asset($userInfo->path_image)}}" alt="User profile picture">
                                    </div>
    
                                    <h2 class="profile-username text-center">
                                        <strong>{{$userInfo->name}}</strong>
                                    </h2>
    
                                    <p class="text-muted text-center">
                                        <u>{{$userInfo->role->name}}</u>
                                    </p>
    
                                    <div class="card-body">
                                        <strong>
                                            <i class="nav-icon fas fa-envelope"></i> 
                                            Email
                                        </strong>
                                        <p class="text-muted">
                                            {{$userInfo->email}}
                                        </p>
                                        <hr>

                                        <strong>
                                            <i class="fas fa-phone-square-alt"></i>
                                            Phone
                                        </strong>
                                        <p class="text-muted">
                                            {{substr($userInfo->phone, 0, 4) . '.' . substr($userInfo->phone, 4, 3) . '.' . substr($userInfo->phone, 7)}}
                                        </p>
                                        <hr>

                                        <strong>
                                            <i class="fas fa-map-marker-alt mr-1"></i> 
                                            Location
                                        </strong>
                                        <p class="text-muted" id="address">
                                
                                        </p>
                                        <hr>
                                      </div>    
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@push('jsFile')
<script>
    getFullAddress('address', '{{$userInfo->address}}', {{$userInfo->ward_id}}, {{$userInfo->district_id}}, {{$userInfo->city_id}})
</script>
@endpush()
