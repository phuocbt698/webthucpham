<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\AdminModel\ArticleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class ArticleController extends Controller
{
    const TITLE = 'Article';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $articles = ArticleModel::all();
            return DataTables::of($articles)
                ->editColumn('deleteMany', function ($article) {
                    $checkBox = '<input type="checkbox" value="' . $article->id . '" name="deleteMany" />';
                    $element = '<div class="d-flex justify-content-around" >' . $checkBox . '</div>';
                    return $element;
                })
                ->addColumn('author', function ($article) {
                    return $article->author->name;
                })
                ->addColumn('status', function ($article) {
                    if ($article->is_active == 1) {
                        $elementStatus = '<span class="badge badge-success">Hiển thị</span>';
                    } else {
                        $elementStatus = '<span class="badge badge-danger">Ẩn</span></span>';
                    }
                    return $elementStatus;
                })
                ->addColumn('action', function ($article) {
                    $routeDetail = route('article.show', $article->id);
                    $routeEdit = route('article.edit', $article->id);
                    $routeDelete = route('article.delete', $article->id);
                    $deleteAjax = "deleteAjax('$routeDelete')";
                    $buttonDetail = '<button class="btn btn-sm btn-warning" onclick="window.location.href=\'' . "$routeDetail'\">" . '<i class="fas fa-eye"> Detail </i>' . '</button>';
                    $buttonEdit = '<button class="btn btn-sm btn-success" onclick="window.location.href=\'' . "$routeEdit'\">" . '<i class="fas fa-pen-alt"> Edit </i>' . '</button>';
                    $buttonDelete = '<button class="btn btn-sm btn-danger btn-delete" onclick="' . "$deleteAjax\">" . ' <i class="fas fa-trash"> Delete </i>' . '</button>';
                    $element = '<div class="d-flex justify-content-around" >' . $buttonDetail . $buttonEdit . $buttonDelete . '</div>';
                    return $element;
                })
                ->rawColumns(['deleteMany', 'action', 'status'])
                ->make(true);
        }
        return view('admin.article.index', [
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
        return view('admin.article.create', [
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
                'description' => 'required',
            ],
            [
                'required' => 'Trường này không được bỏ trống!',
                'min' => 'Độ dài của trường quá ngắn!',
                'max' => 'Độ dài của trường vượt quá giới hạn!',
                'image' => 'Trường này nhận dữ liệu ảnh!',
            ],
        );
        //Xử lý ảnh
        $image = $request->image;
        $nameImage = $image->getClientOriginalName();
        $folderImage = 'uploads/images/article/';
        $newNameImage = $folderImage . 'article-' . time() . '-' . $nameImage;
        $slug = Str::slug($request->title);
        $id_author = Auth::guard('admin')->user()->id;
        //custom request
        $request->merge([
            'slug' => $slug,
            'user_id' => $id_author,
            'path_image' => $newNameImage,
        ]);
        $articleModel = new ArticleModel();
        
        if($articleModel::create($request->all())){
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
        $article = ArticleModel::find($id);
        return view('admin.article.show', [
            'title' => self::TITLE,
            'article' => $article,
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
        $article = ArticleModel::findOrFail($id);
        return view('admin.article.update', [
            'title' => self::TITLE,
            'article' => $article,
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
                'description' => 'required',
            ],
            [
                'required' => 'Trường này không được bỏ trống!',
                'min' => 'Độ dài của trường quá ngắn!',
                'max' => 'Độ dài của trường vượt quá giới hạn!',
                'image' => 'Trường này nhận dữ liệu ảnh!',
            ],
        );
        $articleModel = ArticleModel::find($id);
        //Xử lý ảnh
        if ($request->hasFile('image')) {
            $image = $request->image;
            $nameImage = $image->getClientOriginalName();
            $folderImage = 'uploads/images/article/';
            $newNameImage = $folderImage . 'article-' . time() . '-' . $nameImage;
            @unlink($articleModel->path_image);
            $image->move($folderImage, $newNameImage);
        }
        if ($request->is_active != 1) {
            $request->merge([
                'is_active' => 0,
            ]);
        }
        if ($articleModel->update($request->all())) {
            $href = route('article.index');
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
        $delete = ArticleModel::destroy($id);
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
        $delete = ArticleModel::destroy($listID);
        if ($delete) {
            return response()->json(['statusCode' => 200]);
        } else {
            return response()->json(['statusCode' => 400]);
        }
    }
}
