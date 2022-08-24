@extends('admin.layout.main')
@section('contents')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <a href="{{ route('user.index') }}" class="float-left btn btn-lm btn-warning">
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
                    @method('PUT')
                    <div class="row">

                        <!-- left column -->
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Chỉnh sửa user</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <select class="form-control" name="role" id="role">
                                            <option value="">--Chọn role---</option>
                                            @foreach ($roles as $role)
                                                <option {{($role->id == $user->role_id) ? 'selected' : ''}} value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input value="{{ $user->name ?? '' }}" type="text" class="form-control" id="name" name="name"
                                            placeholder="Enter name">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input value="{{ $user->email ?? '' }}" type="email" class="form-control" id="email" name="email"
                                            placeholder="Enter email">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input value="{{ $user->password ?? '' }}" type="password" class="form-control" id="password" name="password"
                                            placeholder="Enter password">
                                    </div>
                                    <div class="form-group d-flex align-items-start flex-column">
                                        <label for="image">Avatar</label>
                                        <input type="file" id="image" name="image">
                                    </div>
                                    <div class="d-flex mb-2">
                                        <label for="image">Image Old</label>
                                        <img class="w-50 rounded-circle  img-thumbnail preview-img" src="{{asset($user->path_image)}}" alt="">
                                    </div>
                                    <div id="preview" class="d-flex">

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
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input value="{{ $user->phone ?? '' }}"  type="text" class="form-control" id="phone" name="phone"
                                            placeholder="Enter phone">
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea class="form-control" name="address" id="address" cols="50" rows="5" placeholder="Enter address">{{ $user->address ?? '' }}</textarea>
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
        $('#formUpdate').submit(function(event) {
            event.preventDefault();
            var eleValidate = [
                                'role',
                                'name',
                                'email',
                                'password',
                                'image',
                                'phone',
                                'city',
                                'district',
                                'ward'
                            ];
            var data = new FormData(this);
            var url = "{{ route('user.update', $user->id) }}";
            var result = sendAjax(url, data, 'edit');
            if (result) {
                renderError(result, eleValidate);
            } else {
                removeError(eleValidate, 'formUpdate');
            }
        });
        getAddress({{$user->city_id}}, {{$user->district_id}}, {{$user->ward_id}});
        preview('image', 'preview');
    </script>
@endpush
