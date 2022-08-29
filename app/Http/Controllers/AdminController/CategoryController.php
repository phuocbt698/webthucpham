<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\AdminModel\CategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    const TITLE = 'Category';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $categories = CategoryModel::all();
            return DataTables::of($categories)
                ->editColumn('deleteMany', function ($role) {
                    $checkBox = '<input type="checkbox" value="' . $role->id . '" name="deleteMany" />';
                    $element = '<div class="d-flex justify-content-around" >' . $checkBox . '</div>';
                    return $element;
                })
                ->addColumn('parent', function ($category) {
                    if (!empty($category->parentCategory->name)) {
                        $parentCategory = $category->parentCategory->name;
                    } else {
                        $parentCategory = 0;
                    }
                    return $parentCategory;
                })
                ->addColumn('status', function ($category) {
                    if ($category->is_active == 1) {
                        $elementStatus = '<span class="badge badge-success">Hiển thị</span>';
                    } else {
                        $elementStatus = '<span class="badge badge-danger">Ẩn</span></span>';
                    }
                    return $elementStatus;
                })
                ->addColumn('action', function ($category) {
                    $routeEdit = route('category.edit', $category->id);
                    $routeDelete = route('category.delete', $category->id);
                    $deleteAjax = "deleteAjax('$routeDelete')";
                    $buttonEdit = '<button class="btn btn-sm btn-success" onclick="window.location.href=\'' . "$routeEdit'\">" . '<i class="fas fa-pen-alt"> Edit </i>' . '</button>';
                    $buttonDelete = '<button class="btn btn-sm btn-danger btn-delete" onclick="' . "$deleteAjax\">" . ' <i class="fas fa-trash"> Delete </i>' . '</button>';
                    $element = '<div class="d-flex justify-content-around" >' . $buttonEdit . $buttonDelete . '</div>';
                    return $element;
                })
                ->rawColumns(['deleteMany', 'action', 'status'])
                ->make(true);
        }
        return view('admin.category.index', [
            'title' => self::TITLE,
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
        return view('admin.category.create', [
            'title' => self::TITLE,
            'categories' => $categories,
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
                'name' => 'required|max: 250',
            ],
            [
                'required' => 'Trường này không được bỏ trống!',
                'max' => 'Độ dài của trường vượt quá giới hạn!',
            ],
        );

        $slug = Str::slug($request->name);
        $request->merge([
            'slug' => $slug,
        ]);
        $categoryModel = new CategoryModel();
        if ($categoryModel::create($request->all())) {
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
        $categories = CategoryModel::all();
        $category = CategoryModel::findOrFail($id);
        return view('admin.category.update', [
            'title' => self::TITLE,
            'categories' => $categories,
            'category' => $category
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
                'name' => 'required|max: 250',
            ],
            [
                'required' => 'Trường này không được bỏ trống!',
                'max' => 'Độ dài của trường vượt quá giới hạn!',
            ],
        );

        $slug = Str::slug($request->name);
        $request->merge([
            'slug' => $slug,
        ]);
        $categoryModel = CategoryModel::findOrFail($id);
        if ($categoryModel->update($request->all())) {
            $href = route('category.index');
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
        $delete = CategoryModel::destroy($id);
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
        $delete = CategoryModel::destroy($listID);
        if ($delete) {
            return response()->json(['statusCode' => 200]);
        } else {
            return response()->json(['statusCode' => 400]);
        }
    }
}
