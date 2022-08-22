@extends('admin.layout.main')
@section('contents')
    <div class="content-wrapper" style="min-height: 1345.31px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Role</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Chỉnh sửa role</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form onsubmit="return false;" id="formUpdate" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input value="{{$role->name}}" type="text" class="form-control" id="name" name="name"
                                            placeholder="Enter name">
                                        
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="float-right btn btn-primary">Lưu lại</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-6 float-right">
                        <a href="{{route('role.index')}}" class="float-right btn btn-lm btn-warning">
                            <i class="fas fa-list-alt"></i>
                            Danh sách
                        </a>
                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@push('jsFile')
    <script>
        $('#formUpdate').submit(function(){
            var eleValidate = ['name'];
            var data = new FormData($('#formUpdate')[0]);
            var url = "{{route('role.update', $role->id)}}";
            var result = sendAjax(url, data, 'edit');
            if(result){
                renderError(result, eleValidate);
            }else{
                removeError(eleValidate);
            }
        });
    </script>
@endpush