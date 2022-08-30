@extends('admin.layout.main')
@section('contents')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href="{{ route('user.index') }}" class="float-left btn btn-lm btn-warning">
                            <i class="fas fa-list-alt"></i>
                            Danh sách
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Product</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{asset($product->path_image)}}" alt="User profile picture">
                                </div>
                                <strong>
                                    Name
                                </strong>
                                <p class="text-muted">
                                    {{ $product->name }}
                                </p>
                                <hr>
                                <strong>
                                    Slug
                                </strong>
                                <p class="text-muted">
                                    {{ $product->slug }}
                                </p>
                                <hr>
                                <strong>
                                    Category
                                </strong>
                                <p class="text-muted">
                                    {{ $product->category->name }}
                                </p>
                                <hr>
                                <strong>
                                    Brand
                                </strong>
                                <p class="text-muted">
                                    {{ $product->brand->name }}
                                </p>
                                <hr>
                                <strong>
                                    Vendor
                                </strong>
                                <p class="text-muted">
                                    {{ $product->vendor->name }}
                                </p>
                                <hr>
                                <strong>
                                    Is_hot
                                </strong>
                                <p class="text-muted">
                                    @if ($product->is_hot == 1)
                                        <span class="badge badge-success">Hot</span>
                                    @else
                                        <span class="badge badge-warning">Not Hot</span></span>
                                    @endif
                                </p>
                                <hr>
                                <strong>
                                    Status
                                </strong>
                                <p class="text-muted">
                                    @if ($product->is_active == 1)
                                        <span class="badge badge-success">Hiển thị</span>
                                    @else
                                        <span class="badge badge-danger">Ẩn</span></span>
                                    @endif
                                </p>
                                <hr>
                                <strong>
                                    Author
                                </strong>
                                <p class="text-muted">
                                    {{ $product->author->name }}
                                </p>
                                <hr>

                                <a href="{{ route('product.index') }}" class="btn btn-primary btn-block"><b>Danh
                                        sách</b></a>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="activity">
                                        <!-- Post -->
                                        <div class="post">
                                            <strong>
                                                Description
                                            </strong>
                                            <div class="description">
                                                {!! $product->description !!}
                                            </div>
                                        </div>
                                        <!-- /.post -->
                                    </div>
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
