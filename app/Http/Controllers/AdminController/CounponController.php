<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\AdminModel\CounponModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class CounponController extends Controller
{
    const TITLE = 'Counpon';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $counpons = CounponModel::all();
            return DataTables::of($counpons)
                ->editColumn('deleteMany', function ($counpon) {
                    $checkBox = '<input type="checkbox" value="' . $counpon->id . '" name="deleteMany" />';
                    $element = '<div class="d-flex justify-content-around" >' . $checkBox . '</div>';
                    return $element;
                })
                ->addColumn('type', function ($counpon) {
                    if ($counpon->type == 1) {
                        $elementType = '<span class="badge badge-success">Giảm tiền</span>';
                    } else {
                        $elementType = '<span class="badge badge-warning">Giảm %</span></span>';
                    }
                    return $elementType;
                })
                ->addColumn('status', function ($counpon) {
                    if ($counpon->is_active == 1) {
                        $elementStatus = '<span class="badge badge-success">Hiển thị</span>';
                    } else {
                        $elementStatus = '<span class="badge badge-danger">Ẩn</span></span>';
                    }
                    return $elementStatus;
                })
                ->addColumn('action', function ($counpon) {
                    $routeEdit = route('counpon.edit', $counpon->id);
                    $routeDelete = route('counpon.delete', $counpon->id);
                    $deleteAjax = "deleteAjax('$routeDelete')";
                    $buttonEdit = '<button class="btn btn-sm btn-success" onclick="window.location.href=\'' . "$routeEdit'\">" . '<i class="fas fa-pen-alt"> Edit </i>' . '</button>';
                    $buttonDelete = '<button class="btn btn-sm btn-danger btn-delete" onclick="' . "$deleteAjax\">" . ' <i class="fas fa-trash"> Delete </i>' . '</button>';
                    $element = '<div class="d-flex justify-content-around" >' . $buttonEdit . $buttonDelete . '</div>';
                    return $element;
                })
                ->rawColumns(['deleteMany', 'action', 'status', 'type'])
                ->make(true);
        }
        return view('admin.counpon.index', [
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
        return view('admin.counpon.create', [
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
                'type' => 'required',
                'value' => 'required',
                'time_start' => 'required',
                'time_end' => 'required|after:time_start'
            ],
            [
                'required' => 'Trường này không được bỏ trống!',
                'min' => 'Độ dài của trường quá ngắn!',
                'max' => 'Độ dài của trường vượt quá giới hạn!',
                'after' => 'Thời gian kết thúc phải sau thời gian bắt đầu'
            ],
        );
        $slug = Str::slug($request->name);
        //custom request
        $request->merge([
            'slug' => $slug,
        ]);
        $counponModel = new CounponModel();
        if($counponModel::create($request->all())){
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
        $counpon = CounponModel::find($id);
        return view('admin.counpon.update', [
            'title' => self::TITLE,
            'counpon' => $counpon,
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
                'type' => 'required',
                'value' => 'required',
                'time_start' => 'required',
                'time_end' => 'required|after:time_start'
            ],
            [
                'required' => 'Trường này không được bỏ trống!',
                'min' => 'Độ dài của trường quá ngắn!',
                'max' => 'Độ dài của trường vượt quá giới hạn!',
                'after' => 'Thời gian kết thúc phải sau thời gian bắt đầu'
            ],
        );
        $slug = Str::slug($request->name);
        //custom request
        $request->merge([
            'slug' => $slug,
            'is_active' => $request->is_active ?? '0'
        ]);
        $counponModel = CounponModel::find($id);
        if ($counponModel->update($request->all())) {
            $href = route('counpon.index');
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
        $delete = CounponModel::destroy($id);
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
        $delete = CounponModel::destroy($listID);
        if ($delete) {
            return response()->json(['statusCode' => 200]);
        } else {
            return response()->json(['statusCode' => 400]);
        }
    }
}
