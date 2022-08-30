<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\AdminModel\VendorModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Rules\Phone;
use App\Rules\Url;
use Illuminate\Support\Str;
class VendorController extends Controller
{
    const TITLE = 'Vendor';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $vendors = VendorModel::all();
            return DataTables::of($vendors)
                        ->editColumn('deleteMany', function ($vendor) {
                            $checkBox = '<input type="checkbox" value="'.$vendor->id.'" name="deleteMany" />';
                            $element = '<div class="d-flex justify-content-around" >' . $checkBox . '</div>';
                            return $element;
                        })
                        ->addColumn('status', function ($vendor) {
                            if ($vendor->is_active == 1) {
                                $elementStatus = '<span class="badge badge-success">Hiển thị</span>';
                            } else {
                                $elementStatus = '<span class="badge badge-danger">Ẩn</span></span>';
                            }
                            return $elementStatus;
                        })
                        ->addColumn('action', function ($vendor) {
                            $routeDetail = route('vendor.show', $vendor->id);
                            $routeEdit = route('vendor.edit', $vendor->id);
                            $routeDelete = route('vendor.delete', $vendor->id);
                            $deleteAjax = "deleteAjax('$routeDelete')";
                            $buttonDetail = '<button class="btn btn-sm btn-warning" onclick="window.location.href=\'' . "$routeDetail'\">"
                                . '<i class="fas fa-eye"> Detail </i>' . '</button>';
                            $buttonEdit = '<button class="btn btn-sm btn-success" onclick="window.location.href=\'' . "$routeEdit'\">"
                                . '<i class="fas fa-pen-alt"> Edit </i>' . '</button>';
                            $buttonDelete = '<button class="btn btn-sm btn-danger btn-delete" onclick="' . "$deleteAjax\">"
                                . ' <i class="fas fa-trash"> Delete </i>' . '</button>';
                            $element = '<div class="d-flex justify-content-around" >'. $buttonDetail . $buttonEdit . $buttonDelete . '</div>';
                            return $element;
                        })
                        ->rawColumns(['role', 'deleteMany', 'action', 'status'])
                        ->make(true);
        }
        return view('admin.vendor.index', [
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
        return view('admin.vendor.create', [
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
        $request->validate([
            'website' => ['required', new Url('Trường này nhận vào một địa chỉ website!')],
            'name' => 'required|min:3|max: 250',
            'email' => 'required|email|unique:tbl_vendor',
            'phone' => ['required', new Phone('Số điện thoại không đúng định dạng!'), 'unique:tbl_vendor'],
            'image' => 'required|image',
            'city' => 'required',
            'district' => 'required',
            'ward' => 'required',

        ],[
            'required' => 'Trường này không được bỏ trống!',
            'min' => 'Độ dài của trường quá ngắn!',
            'max' => 'Độ dài của trường vượt quá giới hạn!',
            'image' => 'Trường này nhận dữ liệu ảnh!',
            'unique' => 'Dữ liệu hiện tại trùng với trong database!'
        ]);
        //Xử lý ảnh
        $image = $request->image;
        $nameImage = $image->getClientOriginalName();
        $folderImage = 'uploads/images/vendor/';
        $newNameImage = $folderImage . 'vendor-' . time() . '-' . $nameImage;
        $slug = Str::slug($request->name);
        $city = $request->city;
        $district = $request->district;
        $ward = $request->ward;
        //custom request
        $request->merge([
            'path_image' => $newNameImage,
            'slug' =>$slug,
            'city_id' => $city,
            'district_id' => $district,
            'ward_id' => $ward
        ]);
        $vendorModel = new VendorModel();
        if($vendorModel::create($request->all())){
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
        $vendorModel = VendorModel::find($id);
        return view('admin.vendor.show', [
            'title' => self::TITLE,
            'vendor' => $vendorModel
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
        $vendor = VendorModel::findOrFail($id);
        return view('admin.vendor.update', [
            'title' => self::TITLE,
            'vendor' => $vendor
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
            'website' => ['required', new Url('Trường này nhận vào một địa chỉ website!')],
            'name' => 'required|min:3|max: 250',
            'email' => 'required|email|unique:tbl_vendor,email,'.$id,
            'phone' => ['required', new Phone('Số điện thoại không đúng định dạng!'), 'unique:tbl_user,phone,'.$id],
            'image' => 'image',
            'city' => 'required',
            'district' => 'required',
            'ward' => 'required',

        ],[
            'required' => 'Trường này không được bỏ trống!',
            'min' => 'Độ dài của trường quá ngắn!',
            'max' => 'Độ dài của trường vượt quá giới hạn!',
            'image' => 'Trường này nhận dữ liệu ảnh!',
            'unique' => 'Dữ liệu hiện tại trùng với trong database!'
        ]);
        $vendorModel = VendorModel::find($id);
        //Xử lý ảnh
        if($request->hasFile('image')){
            $image = $request->image;
            $nameImage = $image->getClientOriginalName();
            $folderImage = 'uploads/images/vendor/';
            $newNameImage = $folderImage . 'vendor-' . time() . '-' . $nameImage;
            @unlink($vendorModel->path_image);
            $image->move($folderImage, $newNameImage);
        }else{
            $newNameImage = $vendorModel->path_image;
        }
        $slug = Str::slug($request->name);
        $city = $request->city;
        $district = $request->district;
        $ward = $request->ward;
        //custom request
        $request->merge([
            'path_image' => $newNameImage,
            'slug' =>$slug,
            'city_id' => $city,
            'district_id' => $district,
            'ward_id' => $ward
        ]);
        
        if($vendorModel->update($request->all())){
            $href = route('vendor.index');
            return response()->json([
                'success' => ['href' => "$href"]
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
        $delete = VendorModel::destroy($id);
        if ($delete) {
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
        $delete = VendorModel::destroy($listID);
        if ($delete) {
            return response()->json(['statusCode' => 200]);
        } else {
            return response()->json(['statusCode' => 400]);
        }
    }
}
