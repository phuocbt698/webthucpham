@extends('admin.layout.main')
@section('contents')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href="{{route('vendor.index')}}" class="float-left btn btn-lm btn-warning">
                            <i class="fas fa-list-alt"></i>
                            Danh sách
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Vendor</li>
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
                                            src="{{asset($vendor->path_image)}}" alt="Vendor profile picture">
                                    </div>
    
                                    <h2 class="profile-username text-center">
                                        <strong>{{$vendor->name}}</strong>
                                    </h2>    
                                    <p class="text-muted text-center">
                                        <u>{{$vendor->slug}}</u>
                                    </p>
                                    <div class="card-body">
                                        <strong>
                                            <i class="nav-icon fas fa-envelope"></i> 
                                            Email
                                        </strong>
                                        <p class="text-muted">
                                            {{$vendor->email}}
                                        </p>
                                        <hr>

                                        <strong>
                                            <i class="fas fa-phone-square-alt"></i>
                                            Phone
                                        </strong>
                                        <p class="text-muted">
                                            {{substr($vendor->phone, 0, 4) . '.' . substr($vendor->phone, 4, 3) . '.' . substr($vendor->phone, 7)}}
                                        </p>
                                        <hr>
                                        <strong>
                                            <i class="fas fa-info-circle"></i>
                                            Website
                                        </strong>
                                        <p class="text-muted">
                                            {{$vendor->website}}
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
    getFullAddress('address', '{{$vendor->address}}', {{$vendor->ward_id}}, {{$vendor->district_id}}, {{$vendor->city_id}})
</script>
@endpush()
