@extends('admin.layout.main')
@section('contents')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <a href="{{ route('counpon.index') }}" class="float-left btn btn-lm btn-warning">
                            <i class="fas fa-list-alt"></i>
                            Danh sách
                        </a>
                    </div>
                    <div class="col">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Counpon</li>
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
                                    <h3 class="card-title">Thông tin counpon</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input value="{{$counpon->name}}" type="text" class="form-control" id="name" name="name"
                                            placeholder="Enter name">
                                    </div>
                                    <div class="form-group">
                                        <label for="type">Type</label>
                                        <select class="form-control" name="type" id="type">
                                            <option {{($counpon->type == 0) ? 'selected' : ''}} value="0">Giảm phần trăm</option>
                                            <option {{($counpon->type == 1) ? 'selected' : ''}} value="1">Giảm số tiền</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="value">Value</label>
                                        <input value="{{$counpon->value}}" type="number" class="form-control" id="value" name="value" min="0"
                                            placeholder="Enter value">
                                    </div>
                                    <div class="form-group">
                                        <label for="quantity">Quantity</label>
                                        <input value="{{$counpon->quantity}}" type="number" class="form-control" id="quantity" name="quantity" min="0"
                                            placeholder="Enter quantity">
                                    </div>
                                    <div class="form-group">
                                        <label for="time_start">Time_start</label>
                                        <input value="{{ ($counpon->time_start) ? date('Y-m-d', strtotime($counpon->time_start)) : '' }}" class="form-control" type="date" name="time_start" id="time_start">
                                    </div>
                                    <div class="form-group">
                                        <label for="time_end">Time_end</label></label>
                                        <input value="{{ ($counpon->time_end) ? date('Y-m-d', strtotime($counpon->time_end)) : '' }}" class="form-control" type="date" name="time_end" id="time_end">
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input {{ ($counpon->is_active == 1) ? 'checked' : '' }} value="1" type="checkbox" class="form-check-input" id="is_active" name="is_active">
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
                'type',
                'value',
                'time_start',
                'time_end'
            ];
            var data = new FormData(this);
            var url = "{{ route('counpon.update', $counpon->id) }}";
            var result = sendAjax(url, data, 'edit');
            if (!result.href) {
                renderError(result, eleValidate);
            }else {
                window.location.replace(result.href);
                removeError(eleValidate, 'formUpdate');
            }
        });
    </script>
@endpush
