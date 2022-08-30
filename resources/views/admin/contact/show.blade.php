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
                                    Name
                                </strong>
                                <p class="text-muted">
                                    {{ $contact->name }}
                                </p>
                                <hr>
                                <strong>
                                    Email
                                </strong>
                                <p class="text-muted">
                                    {{ $contact->email }}
                                </p>
                                <hr>
                                <strong>
                                    Phone
                                </strong>
                                <p class="text-muted">
                                    {{ $contact->phone }}
                                </p>
                                <hr>
                                <strong>
                                    Status
                                </strong>
                                <form id="formUpdate" action="">
                                    <div class="form-group">
                                        @csrf
                                        @method('PUT')
                                        <select class="form-control" name="status" id="status">
                                            <option {{ ($contact->status == 0) ? 'selected' : '' }} value="0">Chưa xử lý</option>
                                            <option {{ ($contact->status == 1) ? 'selected' : '' }} value="1">Đã xử lý</option>
                                        </select>
                                    </div>    
                                    <div class="card-footer mt-1">
                                        <button type="submit" class="float-right btn btn-sm btn-success">Cập nhật</button>
                                    </div>                             
                                </form>
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
                                            <strong>
                                                Content
                                            </strong>
                                            <div class="description">
                                                {!! $contact->content !!}
                                            </div>
                                        </div>
                                        <div class="post">
                                            <strong style="margin-bottom: 10px;display: block;">
                                                Gửi phản hồi cho khách hàng
                                            </strong>
                                            <div class="feedback" style="margin-bottom:20px">
                                                <form id="formFeedBack" action="">
                                                    <div class="form-group">
                                                        <textarea data-sample-short class="form-control" name="feedback" id="feedback" cols="50" rows="5"></textarea>
                                                    </div>    
                                                    <div class="card-footer mt-1">
                                                        <button type="submit" class="float-right btn btn-sm btn-success">Gửi phản hồi</button>
                                                    </div>                             
                                                </form>
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
@push('jsFile')
    <script>
        CKEDITOR.replace('feedback', {
            width: '100%',
            height: 300,
            editorplaceholder: 'Bạn chỉ cần viết nội dung phản hồi! Tiêu đề và người nhận chúng tôi đã chuẩn bị cho bạn!',
        });
    </script>
    <script>
        $('#formUpdate').submit(function(event) {
            event.preventDefault();
            var data = new FormData(this);
            var url = "{{ route('contact.update', $contact->id) }}";
            var result = sendAjax(url, data, 'edit');
            if (result.href) {
                window.location.replace(result.href);
            }
        });
        $('#formFeedBack').submit(function(event) {
            event.preventDefault();
            var eleValidate = [
                'feedback'
            ];
            var feedback = CKEDITOR.instances.feedback.getData();
            var data = new FormData(this);
            data.append('feedback', feedback);
            var url = "{{ route('contact.feedback', $contact->id) }}";
            var result = sendAjax(url, data, 'mail');
            if (!result.href) {
                renderError(result, eleValidate);
            }else {
                window.location.replace(result.href);
            }
        });
    </script>
@endpush