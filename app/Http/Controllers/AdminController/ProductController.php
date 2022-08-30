<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\AdminModel\BrandModel;
use App\Models\AdminModel\CategoryModel;
use App\Models\AdminModel\ProductModel;
use App\Models\AdminModel\VendorModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    const TITLE = 'Product';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $products = ProductModel::all();
            return DataTables::of($products)
                ->editColumn('deleteMany', function ($product) {
                    $checkBox = '<input type="checkbox" value="' . $product->id . '" name="deleteMany" />';
                    $element = '<div class="d-flex justify-content-around" >' . $checkBox . '</div>';
                    return $element;
                })
                ->addColumn('category', function ($product) {
                    return $product->category->name;
                })
                ->addColumn('author', function ($product) {
                    return $product->author->name;
                })
                ->addColumn('is_hot', function ($product) {
                    if ($product->is_hot == 1) {
                        $elementType = '<span class="badge badge-success">Hot</span>';
                    } else {
                        $elementType = '<span class="badge badge-warning">Not Hot </span></span>';
                    }
                    return $elementType;
                })
                ->addColumn('status', function ($product) {
                    if ($product->is_active == 1) {
                        $elementStatus = '<span class="badge badge-success">Hiển thị</span>';
                    } else {
                        $elementStatus = '<span class="badge badge-danger">Ẩn</span></span>';
                    }
                    return $elementStatus;
                })
                ->addColumn('action', function ($product) {
                    $routeDetail = route('product.show', $product->id);
                    $routeEdit = route('product.edit', $product->id);
                    $routeDelete = route('product.delete', $product->id);
                    $deleteAjax = "deleteAjax('$routeDelete')";
                    $buttonDetail = '<button class="btn btn-sm btn-warning" onclick="window.location.href=\'' . "$routeDetail'\">" . '<i class="fas fa-eye"> Detail </i>' . '</button>';
                    $buttonEdit = '<button class="btn btn-sm btn-success" onclick="window.location.href=\'' . "$routeEdit'\">" . '<i class="fas fa-pen-alt"> Edit </i>' . '</button>';
                    $buttonDelete = '<button class="btn btn-sm btn-danger btn-delete" onclick="' . "$deleteAjax\">" . ' <i class="fas fa-trash"> Delete </i>' . '</button>';
                    $element = '<div class="d-flex justify-content-around" >' . $buttonDetail . $buttonEdit . $buttonDelete . '</div>';
                    return $element;
                })
                ->rawColumns(['deleteMany', 'action', 'status', 'category', 'is_hot', 'author'])
                ->make(true);
        }
        return view('admin.product.index', [
            'title' => self::TITLE
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = CategoryModel::all();
        $brands = BrandModel::all();
        $vendors = VendorModel::all();
        return view('admin.product.create', [
            'title' => self::TITLE,
            'categories' => $categories,
            'brands' => $brands,
            'vendors' => $vendors,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max: 250',
            'category' => 'required',
            'vendor' => 'required',
            'brand' => 'required',
            'price' => 'required',
            'image' => 'required|image',
            'description' => 'required',
        ],[
            'required' => 'Trường này không được bỏ trống!',
            'min' => 'Độ dài của trường quá ngắn!',
            'max' => 'Độ dài của trường vượt quá giới hạn!',
            'image' => 'Trường này nhận dữ liệu ảnh!',
        ]);
        //Xử lý ảnh
        $image = $request->image;
        $nameImage = $image->getClientOriginalName();
        $folderImage = 'uploads/images/product/';
        $newNameImage = $folderImage . 'product-' . time() . '-' . $nameImage;
        $slug = Str::slug($request->name);
        //custom request
        $request->merge([
            'slug'=>$slug,
            'user_id' => Auth::guard('admin')->user()->id,
            'path_image' => $newNameImage,
            'category_id' => $request->category,
            'brand_id' => $request->brand,
            'vendor_id' => $request->vendor,
        ]);
        $productModel = new ProductModel();
        
        if($productModel::create($request->all())){
            $image->move($folderImage, $newNameImage);
            return 1;
        }   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = ProductModel::find($id);
        return view('admin.product.show', [
            'title' => self::TITLE,
            'product' => $product,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = CategoryModel::all();
        $brands = BrandModel::all();
        $vendors = VendorModel::all();
        $product = ProductModel::find($id);
        return view('admin.product.update', [
            'title' => self::TITLE,
            'categories' => $categories,
            'brands' => $brands,
            'vendors' => $vendors,
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3|max: 250',
            'category' => 'required',
            'vendor' => 'required',
            'brand' => 'required',
            'price' => 'required',
            'image' => 'image',
            'description' => 'required',
        ],[
            'required' => 'Trường này không được bỏ trống!',
            'min' => 'Độ dài của trường quá ngắn!',
            'max' => 'Độ dài của trường vượt quá giới hạn!',
            'image' => 'Trường này nhận dữ liệu ảnh!',
        ]);
        $productModel = ProductModel::find($id);
       //Xử lý ảnh
       if ($request->hasFile('image')) {
        $image = $request->image;
        $nameImage = $image->getClientOriginalName();
        $folderImage = 'uploads/images/product/';
        $newNameImage = $folderImage . 'product-' . time() . '-' . $nameImage;
        @unlink($productModel->path_image);
        $image->move($folderImage, $newNameImage);
        $request->merge([
            'path_image' => $newNameImage,
        ]);
    }
        $slug = Str::slug($request->name);
        //custom request
        $request->merge([
            'slug'=>$slug,
            'user_id' => Auth::guard('admin')->user()->id,
            'category_id' => $request->category,
            'brand_id' => $request->brand,
            'vendor_id' => $request->vendor,
            'is_active' => $request->is_active ?? '0',
            'is_hot' => $request->is_active ?? '0'
        ]);
        if ($productModel->update($request->all())) {
            $href = route('product.index');
            return response()->json([
                'success' => ['href' => "$href"],
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $productModel = ProductModel::find($id);
        $delete = ProductModel::destroy($id);
        if ($delete) {
            @unlink($productModel->path_image);
            return response()->json(['statusCode' => 200]);
        } else {
            return response()->json(['statusCode' => 400]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $idArr
     * @return \Illuminate\Http\Response
     */
    public function destroyMany(Request $request)
    {
        $listID = $request->arrID;
        foreach ($listID as $id) {
            $productModel = ProductModel::find($id);
            @unlink($productModel->path_image);
        }
        $delete = ProductModel::destroy($listID);
        if ($delete) {
           
            return response()->json(['statusCode' => 200]);
        } else {
            return response()->json(['statusCode' => 400]);
        }
    }
}
