@extends('admin.layout.main')
@section('contents')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <a href="{{ route('brand.index') }}" class="float-left btn btn-lm btn-warning">
                            <i class="fas fa-list-alt"></i>
                            Danh sách
                        </a>
                    </div>
                    <div class="col">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Brand</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <form id="formUpdate" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Thông tin danh mục</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input value="{{$brand->name}}" type="text" class="form-control" id="name" name="name"
                                            placeholder="Enter name">
                                    </div>
                                    <div class="form-group">
                                        <label for="website">Website</label>
                                        <input value="{{$brand->website}}" type="text" class="form-control" id="website" name="website"
                                            placeholder="Enter website">
                                    </div>
                                    <div class="form-group d-flex align-items-start flex-column">
                                        <label for="image">Image</label>
                                        <input type="file" id="image" name="image">
                                    </div>
                                    <div class="d-flex mb-2">
                                        <label>Image Old</label>
                                        <img class="w-50 img-thumbnail preview-img" src="{{asset($brand->path_image)}}" alt="image banner">
                                    </div>
                                    <div id="preview" class="d-flex">

                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input {{($brand->is_active == 1) ? 'checked' : ''}} value="1" type="checkbox" class="form-check-input" id="is_active"
                                                name="is_active">
                                            <label class="form-check-label" for="is_active">Hiển thị</label>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="float-right btn btn-primary">Lưu lại</button>
                                </div>

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
        $('#formUpdate').submit(function(event) {
            event.preventDefault();
            var eleValidate = [
                'name',
                'website',
                'image'
            ];
            var data = new FormData(this);
            var url = "{{ route('brand.update', $brand->id) }}";
            var result = sendAjax(url, data, 'edit');
            var result = sendAjax(url, data, 'edit');
            if (!result.href) {
                renderError(result, eleValidate);
            }else {
                window.location.replace(result.href);
                removeError(eleValidate, 'formUpdate');
            }
        });
        preview('image', 'preview', false);
    </script>
@endpush
