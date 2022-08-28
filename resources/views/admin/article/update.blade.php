@extends('admin.layout.main')
@section('contents')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <a href="{{ route('article.index') }}" class="float-left btn btn-lm btn-warning">
                            <i class="fas fa-list-alt"></i>
                            Danh sách
                        </a>
                    </div>
                    <div class="col">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">User</li>
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
                    @method('put')
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-4">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Thông tin bài viết</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input value="{{ $article->title ?? '' }}" type="text" class="form-control"
                                            id="title" name="title" placeholder="Enter title">
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input {{ ($article->is_active)  ? 'checked' : ''}} value="1" type="checkbox" class="form-check-input" id="is_active"
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
                        <!-- right column -->
                        <div class="col-md-8">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-body">
                                    <div class="form-group d-flex align-items-start flex-column">
                                        <label for="image">Image</label>
                                        <input type="file" id="image" name="image">
                                    </div>
                                    <div class="d-flex mb-2">
                                        <label for="image">Image Old</label>
                                        <img class="w-50 img-thumbnail preview-img" src="{{asset($article->path_image)}}" alt="">
                                    </div>
                                    <div id="preview" class="d-flex">

                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" name="description" id="description" cols="50" rows="150">{!! $article->description ?? '' !!}</textarea>
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
            height: 400,
            removeButtons: 'PasteFromWord'
        });
    </script>
    <script>
        $('#formUpdate').submit(function(event) {
            event.preventDefault();
            var eleValidate = [
                'title',
                'image',
                'description'
            ];
            var description = CKEDITOR.instances.description.getData();
            var data = new FormData(this);
            data.append('description', description);
            var url = "{{ route('article.update', $article->id)}}";
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
