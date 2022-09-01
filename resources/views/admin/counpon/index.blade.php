@extends('admin.layout.main')
@section('contents')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
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
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title mr-auto p-2">Danh sách counpon</h3>
                                <a href="{{ route('counpon.create') }}" class="p-2 btn btn-lm btn-warning">
                                    <i class="fas fa-plus-square"></i>
                                    Thêm mới
                                </a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="dataTable" class="table table-bordered table-striped">
                                    <div class="mb-3">
                                        <button onclick="deleteManyAjax('{{route('counpon.deleteMany')}}')" id="deleteMany" class="btn btn-lm btn-danger">Delete Many</button>
                                    </div>
                                    <thead class="thead-linght">
                                        <tr>
                                            <th style="width: 10%">Choose</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Value</th>
                                            <th>Quantity</th>
                                            <th>Time_start</th>
                                            <th>Time_end</th>
                                            <th style="width: 25%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@push('jsFile')
    @include('admin.layout.jsTable')
    <script>
      var columns = [
                { data: 'deleteMany', name: 'deleteMany',  "searchable": false ,"orderable": false},
                { data: 'name', name: 'name' },
                { data: 'slug', name: 'slug' },
                { data: 'type', name: 'type' },
                { data: 'status', name: 'status' },
                { data: 'value', name: 'value'},
                { data: 'quantity', name: 'quantity'},
                { data: 'time_start', name: 'time_start'},
                { data: 'time_end', name: 'time_end'},
                { data: 'action', name: 'action',  "orderable": false ,"searchable": false}
              ];
      renderData('dataTable', '{{route('counpon.index')}}', columns);
    </script>
@endpush()
