<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\AdminModel\RoleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    const TITLE = 'Role';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $roles = RoleModel::all();
            return DataTables::of($roles)
                ->editColumn('deleteMany', function ($role) {
                    $checkBox = '<input type="checkbox" value="' . $role->id . '" name="deleteMany" />';
                    $element = '<div class="d-flex justify-content-around" >' . $checkBox . '</div>';
                    return $element;
                })
                ->addColumn('action', function ($role) {
                    $routeEdit = route('role.edit', $role->id);
                    $routeDelete = route('role.delete', $role->id);
                    $deleteAjax = "deleteAjax('$routeDelete')";
                    $buttonEdit = '<button class="btn btn-sm btn-success" onclick="window.location.href=\'' . "$routeEdit'\">" . '<i class="fas fa-pen-alt"> Edit </i>' . '</button>';
                    $buttonDelete = '<button class="btn btn-sm btn-danger btn-delete" onclick="' . "$deleteAjax\">" . ' <i class="fas fa-trash"> Delete </i>' . '</button>';
                    $element = '<div class="d-flex justify-content-around" >' . $buttonEdit . $buttonDelete . '</div>';
                    return $element;
                })
                ->rawColumns(['deleteMany', 'action'])
                ->make(true);
        }
        return view('admin.role.index', [
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
        return view('admin.role.create', [
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
        if ($request->ajax()) {
            $request->validate(
                [
                    'name' => 'required|min:3|max:250|unique:tbl_role',
                ],
                [
                    'required' => 'Tr?????ng n??y kh??ng ???????c b??? tr???ng!',
                    'name.min' => '????? d??i c???a tr?????ng qu?? ng???n!',
                    'name.max' => '????? d??i c???a tr?????ng v?????t qu?? gi???i h???n!',
                    'name.unique' => 'D??? li???u hi???n t???i tr??ng v???i trong database!',
                ],
            );
            $roleModel = new RoleModel();
            $roleModel->create($request->all());
            return true;
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
        $role = RoleModel::findOrFail($id);
        return view('admin.role.update', [
            'title' => self::TITLE,
            'role' => $role,
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
        if ($request->ajax()) {
            $request->validate(
                [
                    'name' => 'required|min:3|max:250|unique:tbl_role,name,' . $id,
                ],
                [
                    'required' => 'Tr?????ng n??y kh??ng ???????c b??? tr???ng!',
                    'name.min' => '????? d??i c???a tr?????ng qu?? ng???n!',
                    'name.max' => '????? d??i c???a tr?????ng v?????t qu?? gi???i h???n!',
                    'name.unique' => 'D??? li???u hi???n t???i tr??ng v???i trong database!',
                ],
            );
            $role = RoleModel::find($id);
            if ($role->update($request->all())) {
                $href = route('user.index');
                return response()->json([
                    'success' => ['href' => "$href"],
                ]);
            }
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
        $delete = RoleModel::destroy($id);
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
        $delete = RoleModel::destroy($listID);
        if ($delete) {
            return response()->json(['statusCode' => 200]);
        } else {
            return response()->json(['statusCode' => 400]);
        }
    }
}
