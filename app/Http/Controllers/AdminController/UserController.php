<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\AdminModel\RoleModel;
use App\Models\AdminModel\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    const TITLE = 'User';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = UserModel::all();
            return DataTables::of($users)
                        ->editColumn('deleteMany', function ($user) {
                            $checkBox = '<input type="checkbox" value="'.$user->id.'" name="deleteMany" />';
                            $element = '<div class="d-flex justify-content-around" >' . $checkBox . '</div>';
                            return $element;
                        })
                        ->addColumn('action', function ($user) {
                            $routeEdit = route('user.edit', $user->id);
                            $routeDelete = route('user.delete', $user->id);
                            $deleteAjax = "deleteAjax('$routeDelete')";
                            $buttonEdit = '<button class="btn btn-sm btn-success" onclick="window.location.href=\'' . "$routeEdit'\">"
                                . '<i class="fas fa-pen-alt"> Edit </i>' . '</button>';
                            $buttonDelete = '<button class="btn btn-sm btn-danger btn-delete" onclick="' . "$deleteAjax\">"
                                . ' <i class="fas fa-trash"> Delete </i>' . '</button>';
                            $element = '<div class="d-flex justify-content-around" >' . $buttonEdit . $buttonDelete . '</div>';
                            return $element;
                        })
                        ->rawColumns(['deleteMany', 'action'])
                        ->make(true);
        }
        return view('admin.user.index', [
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
        $roles = RoleModel::all();
        return view('admin.user.create', [
            'title' => self::TITLE,
            'roles' => $roles
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
