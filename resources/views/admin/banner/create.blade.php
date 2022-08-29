@extends('admin.layout.main')
@section('contents')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <a href="{{ route('banner.index') }}" class="float-left btn btn-lm btn-warning">
                            <i class="fas fa-list-alt"></i>
                            Danh sách
                        </a>
                    </div>
                    <div class="col">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Banner</li>
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
                        <div class="col-md-4">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Thông tin banner</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" id="title" name="title"
                                            placeholder="Enter title">
                                    </div>
                                    <div class="form-group">
                                        <label for="type">Kiểu</label>
                                        <select class="form-control" name="type" id="type">
                                            <option value="0">Banner</option>
                                            <option value="1">Slide</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="time_start">Time_start</label>
                                        <input class="form-control" type="date" name="time_start" id="time_start">
                                    </div>
                                    <div class="form-group">
                                        <label for="time_end">Time_end</label></label>
                                        <input class="form-control" type="date" name="time_end" id="time_end">
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input value="1" type="checkbox" class="form-check-input" id="is_active" name="is_active">
                                            <label class="form-check-label" for="is_active">Hiển thị</label>
                                        </div>
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
                        <div class="col-md-8">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-body">
                                    <div class="form-group d-flex align-items-start flex-column">
                                        <label for="image">Image</label>
                                        <input type="file" id="image" name="image">
                                    </div>
                                    <div id="preview" class="d-flex">

                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" name="description" id="description" cols="50" rows="5"></textarea>
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
        CKEDITOR.replace('description', {
            width: '100%',
            height: 300,
            removeButtons: 'PasteFromWord'
        });
    </script>
    <script>
        $('#formCreate').submit(function(event) {
            event.preventDefault();
            var eleValidate = [
                'title',
                'image',
                'description',
                'time_start',
                'time_end'
            ];
            var description = CKEDITOR.instances.description.getData();
            var data = new FormData(this);
            data.append('description', description);
            var url = "{{ route('banner.store') }}";
            var result = sendAjax(url, data, 'add');
            if (result) {
                renderError(result, eleValidate);
            } else {
                removeError(eleValidate, 'formCreate');
                CKEDITOR.instances.description.setData('');
                removeImage('preview');
            }
        });
        preview('image', 'preview', false);
    </script>
@endpush
