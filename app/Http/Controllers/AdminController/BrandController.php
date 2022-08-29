<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\AdminModel\BrandModel;
use App\Rules\Url;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    const TITLE = 'Brand';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $brands = BrandModel::all();
            return DataTables::of($brands)
                ->editColumn('deleteMany', function ($brand) {
                    $checkBox = '<input type="checkbox" value="' . $brand->id . '" name="deleteMany" />';
                    $element = '<div class="d-flex justify-content-around" >' . $checkBox . '</div>';
                    return $element;
                })
                ->addColumn('status', function ($brand) {
                    if ($brand->is_active == 1) {
                        $elementStatus = '<span class="badge badge-success">Hiển thị</span>';
                    } else {
                        $elementStatus = '<span class="badge badge-danger">Ẩn</span></span>';
                    }
                    return $elementStatus;
                })
                ->addColumn('image', function ($brand) {
                    $elementImage =  '<img class="w-70 rounded-circle  img-thumbnail preview-img" src='.asset($brand->path_image)."></img>";
                    return $elementImage;
                })
                ->addColumn('action', function ($brand) {
                    $routeEdit = route('brand.edit', $brand->id);
                    $routeDelete = route('brand.delete', $brand->id);
                    $deleteAjax = "deleteAjax('$routeDelete')";
                    $buttonEdit = '<button class="btn btn-sm btn-success" onclick="window.location.href=\'' . "$routeEdit'\">" . '<i class="fas fa-pen-alt"> Edit </i>' . '</button>';
                    $buttonDelete = '<button class="btn btn-sm btn-danger btn-delete" onclick="' . "$deleteAjax\">" . ' <i class="fas fa-trash"> Delete </i>' . '</button>';
                    $element = '<div class="d-flex justify-content-around" >' . $buttonEdit . $buttonDelete . '</div>';
                    return $element;
                })
                ->rawColumns(['deleteMany', 'action', 'status', 'image'])
                ->make(true);
        }
        return view('admin.brand.index', [
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
        return view('admin.brand.create', [
            'title' => self::TITLE
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
        $request->validate(
            [
                'name' => 'required|min:2|max: 250',
                'image' => 'required|image',
                'website' => ['required', new Url('Trường này nhận vào một địa chỉ website!')],
            ],
            [
                'required' => 'Trường này không được bỏ trống!',
                'min' => 'Độ dài của trường quá ngắn!',
                'max' => 'Độ dài của trường vượt quá giới hạn!',
                'image' => 'Trường này nhận dữ liệu ảnh!'
            ],
        );
        //Xử lý ảnh
        $image = $request->image;
        $nameImage = $image->getClientOriginalName();
        $folderImage = 'uploads/images/brand/';
        $newNameImage = $folderImage . 'brand-' . time() . '-' . $nameImage;
        $slug = Str::slug($request->name);
        //custom request
        $request->merge([
            'slug' => $slug,
            'path_image' => $newNameImage,
        ]);
        $bannerModel = new BrandModel();
        
        if($bannerModel::create($request->all())){
            $image->move($folderImage, $newNameImage);
            return 1;
        }   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = BrandModel::findOrFail($id);
        return view('admin.brand.update', [
            'title' => self::TITLE,
            'brand' => $brand
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
        $request->validate(
            [
                'name' => 'required|min:2|max: 250',
                'image' => 'image',
                'website' => ['required', new Url('Trường này nhận vào một địa chỉ website!')],
            ],
            [
                'required' => 'Trường này không được bỏ trống!',
                'min' => 'Độ dài của trường quá ngắn!',
                'max' => 'Độ dài của trường vượt quá giới hạn!',
                'image' => 'Trường này nhận dữ liệu ảnh!'
            ],
        );
        $brandModel = BrandModel::find($id);
        //Xử lý ảnh
        if ($request->hasFile('image')) {
            $image = $request->image;
            $nameImage = $image->getClientOriginalName();
            $folderImage = 'uploads/images/brand/';
            $newNameImage = $folderImage . 'brand-' . time() . '-' . $nameImage;
            @unlink($brandModel->path_image);
            $image->move($folderImage, $newNameImage);
            $request->merge([
                'path_image' => $newNameImage,
            ]);
        }
        $slug = Str::slug($request->name);
        //custom request
        $request->merge([
            'slug' => $slug
        ]);
        if ($brandModel->update($request->all())) {
            $href = route('brand.index');
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
        $bannerModel = BrandModel::find($id);
        $delete = BrandModel::destroy($id);
        if ($delete) {
            @unlink($bannerModel->path_image);
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
            $bannerModel = BrandModel::find($id);
            @unlink($bannerModel->path_image);
        }
        $delete = BrandModel::destroy($listID);
        if ($delete) {
           
            return response()->json(['statusCode' => 200]);
        } else {
            return response()->json(['statusCode' => 400]);
        }
    }
}
