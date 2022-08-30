@extends('admin.layout.main')
@section('contents')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Contact</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Contact</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <strong>
                                    Title
                                </strong>
                                <p class="text-muted">
                                    {{ $contact->title }}
                                </p>
                                <hr>
                                <strong>
                                    Slug
                                </strong>
                                <p class="text-muted">
                                    {{ $contact->slug }}
                                </p>
                                <hr>
                                <strong>
                                    Type
                                </strong>
                                <p class="text-muted">
                                    @if ($contact->type == 1)
                                        <span class="badge badge-success">Slide</span>
                                    @else
                                        <span class="badge badge-warning">Contact</span></span>
                                    @endif
                                </p>
                                <hr>
                                <strong>
                                    Status
                                </strong>
                                <p class="text-muted">
                                    @if ($contact->is_active == 1)
                                        <span class="badge badge-success">Hiển thị</span>
                                    @else
                                        <span class="badge badge-danger">Ẩn</span></span>
                                    @endif
                                </p>
                                <hr>
                                <strong>
                                    Time_start
                                </strong>
                                <p class="text-muted">
                                    {{ date('d/m/Y', strtotime($contact->time_start)) }}
                                </p>
                                <hr>
                                <strong>
                                    Time_end
                                </strong>
                                <p class="text-muted">
                                    {{ date('d/m/Y', strtotime($contact->time_end)) }}
                                </p>
                                <hr>
                                <strong>
                                    Time_create
                                </strong>
                                <p class="text-muted">
                                    {{ compareTime($contact->created_at) }}
                                </p>
                                <hr>

                                <a href="{{ route('contact.index') }}" class="btn btn-primary btn-block"><b>Danh
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
                                            <div class="user-block">
                                                <strong>
                                                    Image
                                                </strong>
                                            </div>
                                            <img style="width: 100%; height: 400px" src="{{ asset($contact->path_image) }}"
                                                alt="" srcset="">
                                            <hr>
                                            <strong>
                                                Description
                                            </strong>
                                            <div class="description">
                                                {!! $contact->description !!}
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
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
