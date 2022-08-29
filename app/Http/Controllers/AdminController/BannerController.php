<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\AdminModel\BannerModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    const TITLE = 'Banner';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $banners = BannerModel::all();
            return DataTables::of($banners)
                ->editColumn('deleteMany', function ($banner) {
                    $checkBox = '<input type="checkbox" value="' . $banner->id . '" name="deleteMany" />';
                    $element = '<div class="d-flex justify-content-around" >' . $checkBox . '</div>';
                    return $element;
                })
                ->addColumn('typeBanner', function ($banner) {
                    if ($banner->type == 1) {
                        $elementType = '<span class="badge badge-success">Slide</span>';
                    } else {
                        $elementType = '<span class="badge badge-warning">Banner</span></span>';
                    }
                    return $elementType;
                })
                ->addColumn('status', function ($banner) {
                    if ($banner->is_active == 1) {
                        $elementStatus = '<span class="badge badge-success">Hiển thị</span>';
                    } else {
                        $elementStatus = '<span class="badge badge-danger">Ẩn</span></span>';
                    }
                    return $elementStatus;
                })
                ->addColumn('action', function ($banner) {
                    $routeDetail = route('banner.show', $banner->id);
                    $routeEdit = route('banner.edit', $banner->id);
                    $routeDelete = route('banner.delete', $banner->id);
                    $deleteAjax = "deleteAjax('$routeDelete')";
                    $buttonDetail = '<button class="btn btn-sm btn-warning" onclick="window.location.href=\'' . "$routeDetail'\">" . '<i class="fas fa-eye"> Detail </i>' . '</button>';
                    $buttonEdit = '<button class="btn btn-sm btn-success" onclick="window.location.href=\'' . "$routeEdit'\">" . '<i class="fas fa-pen-alt"> Edit </i>' . '</button>';
                    $buttonDelete = '<button class="btn btn-sm btn-danger btn-delete" onclick="' . "$deleteAjax\">" . ' <i class="fas fa-trash"> Delete </i>' . '</button>';
                    $element = '<div class="d-flex justify-content-around" >' . $buttonDetail . $buttonEdit . $buttonDelete . '</div>';
                    return $element;
                })
                ->rawColumns(['deleteMany', 'action', 'status', 'typeBanner'])
                ->make(true);
        }
        return view('admin.banner.index', [
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
        return view('admin.banner.create', [
            'title' => self::TITLE,
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
                'title' => 'required|min:3|max: 250',
                'image' => 'required|image',
                'description' => 'required|max:250',
                'time_start' => 'required',
                'time_end' => 'required|after:time_start'
            ],
            [
                'required' => 'Trường này không được bỏ trống!',
                'min' => 'Độ dài của trường quá ngắn!',
                'max' => 'Độ dài của trường vượt quá giới hạn 255!',
                'image' => 'Trường này nhận dữ liệu ảnh!',
                'after' => 'Thời gian kết thúc phải sau thời gian bắt đầu'
            ],
        );
        //Xử lý ảnh
        $image = $request->image;
        $nameImage = $image->getClientOriginalName();
        $folderImage = 'uploads/images/banner/';
        $newNameImage = $folderImage . 'banner-' . time() . '-' . $nameImage;
        $slug = Str::slug($request->title);
        //custom request
        $request->merge([
            'slug' => $slug,
            'path_image' => $newNameImage,
        ]);
        $bannerModel = new BannerModel();
        
        if($bannerModel::create($request->all())){
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
        $banner = BannerModel::find($id);
        return view('admin.banner.show', [
            'title' => self::TITLE,
            'banner' => $banner,
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
        $banner = BannerModel::findOrFail($id);
        return view('admin.banner.update', [
            'title' => self::TITLE,
            'banner' => $banner,
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
                'title' => 'required|min:3|max: 250',
                'image' => 'image',
                'description' => 'required|max:250',
                'time_start' => 'required',
                'time_end' => 'required|after:time_start'
            ],
            [
                'required' => 'Trường này không được bỏ trống!',
                'min' => 'Độ dài của trường quá ngắn!',
                'max' => 'Độ dài của trường vượt quá giới hạn 255!',
                'image' => 'Trường này nhận dữ liệu ảnh!',
                'after' => 'Thời gian kết thúc phải sau thời gian bắt đầu'
            ],
        );
        $bannerModel = BannerModel::find($id);
        //Xử lý ảnh
        if ($request->hasFile('image')) {
            $image = $request->image;
            $nameImage = $image->getClientOriginalName();
            $folderImage = 'uploads/images/banner/';
            $newNameImage = $folderImage . 'banner-' . time() . '-' . $nameImage;
            @unlink($bannerModel->path_image);
            $image->move($folderImage, $newNameImage);
            $request->merge([
                'path_image' => $newNameImage,
            ]);
        }
        $slug = Str::slug($request->title);
        //custom request
        $request->merge([
            'slug' => $slug
        ]);
        if ($bannerModel->update($request->all())) {
            $href = route('banner.index');
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
        $delete = BannerModel::destroy($id);
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
        $delete = BannerModel::destroy($listID);
        if ($delete) {
            return response()->json(['statusCode' => 200]);
        } else {
            return response()->json(['statusCode' => 400]);
        }
    }
}
