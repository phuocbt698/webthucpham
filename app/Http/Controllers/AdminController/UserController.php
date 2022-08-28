<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\AdminModel\RoleModel;
use App\Models\AdminModel\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Rules\Phone;
use Illuminate\Support\Facades\Auth;

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
                        ->addColumn('role', function ($user) {
                            return $user->role->name;
                        })
                        ->addColumn('action', function ($user) {
                            $routeDetail = route('user.show', $user->id);
                            $routeEdit = route('user.edit', $user->id);
                            $routeDelete = route('user.delete', $user->id);
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
        $request->validate([
            'role' => 'required',
            'name' => 'required|min:3|max: 250',
            'email' => 'required|email|unique:tbl_user',
            'password' => 'required|min:3|max:250',
            'phone' => ['required', new Phone('Số điện thoại không đúng định dạng!'), 'unique:tbl_user'],
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
        $folderImage = 'uploads/images/admin/';
        $newNameImage = $folderImage . 'user-' . time() . '-' . $nameImage;
        $role = $request->role;
        $bcryptPassword = bcrypt($request->password);
        $city = $request->city;
        $district = $request->district;
        $ward = $request->ward;
        //custom request
        $request->merge([
            'role_id' => $role,
            'password' => $bcryptPassword,
            'path_image' => $newNameImage,
            'city_id' => $city,
            'district_id' => $district,
            'ward_id' => $ward
        ]);
        $userModel = new UserModel();
        $userModel::create($request->all());
        $image->move($folderImage, $newNameImage);
        return 1;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userNow = Auth::guard('admin')->user()->id;
        $userNow = UserModel::findOrFail($userNow);
        $user = UserModel::findOrFail($id);
        if($userNow->can('view', $user)){
            return view('admin.user.show',[
                'title' => self::TITLE,
                'userInfo' => $user
            ]);
        }else{
            return redirect()->back()->with('message', 'Bạn không thể xem thông tin của người khác!');
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
        $userNow = Auth::guard('admin')->user()->id;
        $userNow = UserModel::findOrFail($userNow);
        $user = UserModel::findOrFail($id);
        $roles = RoleModel::all();
        if($userNow->can('update', $user)){
            return view('admin.user.update', [
                'title' => self::TITLE,
                'user' => $user,
                'roles' => $roles
            ]);
        }else{
            return redirect()->back()->with('message', 'Bạn không thể chỉnh sửa thông tin của người khác!');
        }
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
        $userNow = Auth::guard('admin')->user()->id;
        $userNow = UserModel::findOrFail($userNow);
        $userModel = UserModel::findOrFail($id);
        if($userNow->can('update', $userModel)){
            $request->validate([
                'role' => 'required',
                'name' => 'required|min:3|max: 250',
                'email' => 'required|email|unique:tbl_user,email,' . $id,
                'password' => 'required|min:3|max:250',
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
            //Xử lý ảnh
            if($request->hasFile('image')){
                $image = $request->image;
                $nameImage = $image->getClientOriginalName();
                $folderImage = 'uploads/images/admin/';
                $newNameImage = $folderImage . 'user-' . time() . '-' . $nameImage;
                @unlink($userModel->path_image);
                $image->move($folderImage, $newNameImage);
            }else{
                $newNameImage = $userModel->path_image;
            }
    
            if(strcmp($request->password, $userModel->password)){
                $bcryptPassword = bcrypt($request->password);
            }else{
                $bcryptPassword = $request->password;
            }
    
            
            $role = $request->role;
            $city = $request->city;
            $district = $request->district;
            $ward = $request->ward;
            //custom request
            $request->merge([
                'role_id' => $role,
                'password' => $bcryptPassword,
                'path_image' => $newNameImage,
                'city_id' => $city,
                'district_id' => $district,
                'ward_id' => $ward
            ]);
            if($userModel->update($request->all())){
                $href = route('user.index');
                return response()->json([
                    'success' => ['href' => "$href"]
                ]);
            }
        }else{
            return redirect()->back()->with('message', 'Bạn không thể chỉnh sửa thông tin của người khác!');
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
        
        $userNow = Auth::guard('admin')->user()->id;
        if($id == $userNow){
            return response()->json(['statusCode' => 423]);
        }else{
            $delete = UserModel::destroy($id);
            if($delete){
                return response()->json(['statusCode' => 200]);
            }else{
                return response()->json(['statusCode' => 400]);
            }
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
        $userNow = Auth::guard('admin')->user()->id;
        $checkIdNow = in_array($userNow, $listID, false);
        if(!$checkIdNow){
            $delete = UserModel::destroy($listID);
            if($delete){
                return response()->json(['statusCode' => 200]);
            }else{
                return response()->json(['statusCode' => 400]);
            }
        }else{
            return response()->json(['statusCode' => 423]);
        }
    }
}
