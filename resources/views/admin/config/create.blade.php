@extends('admin.layout.main')
@section('contents')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <a href="{{ route('config.index') }}" class="float-left btn btn-lm btn-warning">
                            <i class="fas fa-list-alt"></i>
                            Danh sách
                        </a>
                    </div>
                    <div class="col">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Config</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <form id="formCreate" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <!-- left column -->
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Thông tin config</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Enter email">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="phone"
                                            placeholder="Enter phone">
                                    </div>
                                    <div class="form-group">
                                        <label for="facebook">Facebook</label>
                                        <input type="text" class="form-control" id="facebook" name="facebook"
                                            placeholder="Enter facebook">
                                    </div>
                                    <div class="form-group">
                                        <label for="git">Github</label>
                                        <input type="text" class="form-control" id="git" name="git"
                                            placeholder="Enter github">
                                    </div>
                                    <div class="form-group d-flex align-items-start flex-column">
                                        <label for="image">Logo</label>
                                        <input type="file" id="image" name="image">
                                    </div>
                                    <div id="preview" class="d-flex">

                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="float-right btn btn-primary">Thêm mới</button>
                                </div>

                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- right column -->
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea class="form-control" name="address" id="address" cols="50" rows="5" placeholder="Enter address"></textarea>
                                    </div>

                                    <div class="form-group d-flex justify-content-between">
                                        <div style="width: 48%">
                                            <label for="city">City</label>
                                            <select class="form-control" name="city" id="city">
                                                <option value="">--Chọn Tỉnh/Thành---</option>
                                            </select>
                                        </div>
                                        <div style="width: 48%">
                                            <label for="district">District</label>
                                            <select class="form-control" name="district" id="district">
                                                <option value="">--Chọn Quận/Huyện---</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="ward">Ward</label>
                                        <select class="form-control" name="ward" id="ward">
                                            <option value="">--Chọn Xã/Phường---</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>

                            <!-- /.card -->
                        </div>

                    </div>
                </form>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@push('jsFile')
    <script>
        $('#formCreate').submit(function(event) {
            event.preventDefault();
            var eleValidate = [
                'email',
                'phone',
                'facebook',
                'git',
                'image',
                'city',
                'district',
                'ward'
            ];
            var data = new FormData(this);
            var url = "{{ route('config.store') }}";
            var result = sendAjax(url, data, 'add');
            console.log(result);
            if (result) {
                renderError(result, eleValidate);
            } else {
                removeError(eleValidate, 'formCreate');
                removeImage('preview');
            }
        });
        getAddress();
        preview('image', 'preview');
    </script>
@endpush
