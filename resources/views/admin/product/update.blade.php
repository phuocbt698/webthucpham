@extends('admin.layout.main')
@section('contents')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <a href="{{ route('product.index') }}" class="float-left btn btn-lm btn-warning">
                            <i class="fas fa-list-alt"></i>
                            Danh sách
                        </a>
                    </div>
                    <div class="col">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Product</li>
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
                                    <h3 class="card-title">Thông tin product</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="category">Category</label>
                                        <select class="form-control" name="category" id="category">
                                            <option value="">--Chọn category---</option>
                                            @foreach ($categories as $category)
                                                <option {{($product->category_id == $category->id) ? 'selected' : ''}} value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="brand">Brand</label>
                                        <select class="form-control" name="brand" id="brand">
                                            <option value="">--Chọn brand---</option>
                                            @foreach ($brands as $brand)
                                                <option  {{($product->brand_id == $brand->id) ? 'selected' : ''}} value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="vendor">Vendor</label>
                                        <select class="form-control" name="vendor" id="vendor">
                                            <option value="">--Chọn vendor---</option>
                                            @foreach ($vendors as $vendor)
                                                <option {{($product->vendor_id == $vendor->id) ? 'selected' : ''}} value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input value="{{$product->name}}" type="text" class="form-control" id="name" name="name"
                                            placeholder="Enter name">
                                    </div>
                                    <div class="form-group">
                                        <label for="stock">Stock</label>
                                        <input value="{{$product->stock}}" type="number" class="form-control" id="stock" name="stock" min="0" max="10000"
                                            placeholder="Enter stock">
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input value="{{$product->price}}" type="number" class="form-control" id="price" name="price" min="0"
                                            placeholder="Enter price">
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input {{($product->is_hot == 1) ? 'checked' : ''}} value="1" type="checkbox" class="form-check-input" id="is_hot" name="is_hot">
                                            <label class="form-check-label" for="is_hot">Is_hot</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input {{($product->is_active == 1) ? 'checked' : ''}} value="1" type="checkbox" class="form-check-input" id="is_active" name="is_active">
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
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-body">
                                    <div class="form-group d-flex align-items-start flex-column">
                                        <label for="image">Image</label>
                                        <input type="file" id="image" name="image">
                                    </div>
                                    <div class="d-flex mb-2">
                                        <label>Image Old</label>
                                        <img class="w-50 img-thumbnail preview-img" src="{{asset($product->path_image)}}" alt="image banner">
                                    </div>
                                    <div id="preview" class="d-flex">

                                    </div>
                                    <div class="form-group">
                                        <label for="description">Address</label>
                                        <textarea class="form-control" name="description" id="description" cols="50" rows="5" placeholder="Enter address">{!!$product->description!!}</textarea>
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
        $('#formUpdate').submit(function(event) {
            event.preventDefault();
            var eleValidate = [
                'name',
                'category',
                'vendor',
                'brand',
                'description',
                'image',
                'price',
            ];
            var description = CKEDITOR.instances.description.getData();
            var data = new FormData(this);
            data.append('description', description);
            var url = "{{ route('product.update', $product->id) }}";
            var result = sendAjax(url, data, 'edit');
            if (!result.href) {
                renderError(result, eleValidate);
            }else {
                window.location.replace(result.href);
                removeError(eleValidate, 'formUpdate');
            }
        });
        getAddress();
        preview('image', 'preview');
    </script>
@endpush
