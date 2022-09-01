<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\AdminModel\ConfigModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Rules\Phone;
use App\Rules\Url;

class ConfigController extends Controller
{
    const TITLE = 'Config';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $configs = ConfigModel::all();
            return DataTables::of($configs)
                        ->editColumn('deleteMany', function ($config) {
                            $checkBox = '<input type="checkbox" value="'.$config->id.'" name="deleteMany" />';
                            $element = '<div class="d-flex justify-content-around" >' . $checkBox . '</div>';
                            return $element;
                        })
                        ->addColumn('action', function ($config) {
                            $routeDetail = route('config.show', $config->id);
                            $routeEdit = route('config.edit', $config->id);
                            $routeDelete = route('config.delete', $config->id);
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
                        ->rawColumns(['role', 'deleteMany', 'action'])
                        ->make(true);
        }
        return view('admin.config.index', [
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
        return view('admin.config.create', [
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
            'email' => 'required|email',
            'phone' => ['required', new Phone('Số điện thoại không đúng định dạng!')],
            'facebook' => ['required', new Url('Trường này nhận vào một địa chỉ website!')],
            'git' => ['required', new Url('Trường này nhận vào một địa chỉ website!')],
            'image' => 'required|image',
            'city' => 'required',
            'district' => 'required',
            'ward' => 'required',

        ],[
            'required' => 'Trường này không được bỏ trống!',
            'min' => 'Độ dài của trường quá ngắn!',
            'max' => 'Độ dài của trường vượt quá giới hạn!',
            'image' => 'Trường này nhận dữ liệu ảnh!'
        ]);
        //Xử lý ảnh
        $image = $request->image;
        $nameImage = $image->getClientOriginalName();
        $folderImage = 'uploads/images/logo/';
        $newNameImage = $folderImage . 'logo-' . time() . '-' . $nameImage;
        $city = $request->city;
        $district = $request->district;
        $ward = $request->ward;
        //custom request
        $request->merge([
            'logo' => $newNameImage,
            'city_id' => $city,
            'district_id' => $district,
            'ward_id' => $ward
        ]);
        $configModel = new ConfigModel();
        if($configModel::create($request->all())){
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
        $config = ConfigModel::findOrFail($id);
        return view('admin.config.show', [
            'title' => self::TITLE,
            'config' => $config
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
        $config = ConfigModel::findOrFail($id);
        return view('admin.config.update', [
            'title' => self::TITLE,
            'config' => $config
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
            'email' => 'required|email',
            'phone' => ['required', new Phone('Số điện thoại không đúng định dạng!')],
            'facebook' => ['required', new Url('Trường này nhận vào một địa chỉ website!')],
            'git' => ['required', new Url('Trường này nhận vào một địa chỉ website!')],
            'image' => 'image',
            'city' => 'required',
            'district' => 'required',
            'ward' => 'required',

        ],[
            'required' => 'Trường này không được bỏ trống!',
            'min' => 'Độ dài của trường quá ngắn!',
            'max' => 'Độ dài của trường vượt quá giới hạn!',
            'image' => 'Trường này nhận dữ liệu ảnh!'
        ]);
        $configModel = ConfigModel::find($id);
        if($request->hasFile('image')){
            $image = $request->image;
            $nameImage = $image->getClientOriginalName();
            $folderImage = 'uploads/images/logo/';
            $newNameImage = $folderImage . 'logo-' . time() . '-' . $nameImage;
            @unlink($configModel->logo);
            $image->move($folderImage, $newNameImage);
        }else{
            $newNameImage = $configModel->logo;
        }
        $city = $request->city;
        $district = $request->district;
        $ward = $request->ward;
        //custom request
        $request->merge([
            'logo' => $newNameImage,
            'city_id' => $city,
            'district_id' => $district,
            'ward_id' => $ward
        ]);
        if($configModel->update($request->all())){
            $href = route('config.index');
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
        $configModel = ConfigModel::find($id);
        $delete = ConfigModel::destroy($id);
        if ($delete) {
            @unlink($configModel->logo);
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
            $configModel = ConfigModel::find($id);
            @unlink($configModel->logo);
        }
        $delete = ConfigModel::destroy($listID);
        if ($delete) {
           
            return response()->json(['statusCode' => 200]);
        } else {
            return response()->json(['statusCode' => 400]);
        }
    }
}
