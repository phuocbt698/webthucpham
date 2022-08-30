<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\AdminModel\ContactModel;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\DataTables;

class ContactController extends Controller
{
    const TITLE = 'Contact';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $contacts = ContactModel::all();
            return DataTables::of($contacts)
                ->editColumn('deleteMany', function ($contact) {
                    $checkBox = '<input type="checkbox" value="' . $contact->id . '" name="deleteMany" />';
                    $element = '<div class="d-flex justify-content-around" >' . $checkBox . '</div>';
                    return $element;
                })
                ->addColumn('status', function ($contact) {
                    if ($contact->status == 1) {
                        $elementStatus = '<span class="badge badge-success">Đã xử lý</span>';
                    } else {
                        $elementStatus = '<span class="badge badge-danger">Chưa xử lý</span></span>';
                    }
                    return $elementStatus;
                })
                ->addColumn('action', function ($contact) {
                    $routeDetail = route('contact.show', $contact->id);
                    $routeDelete = route('contact.delete', $contact->id);
                    $deleteAjax = "deleteAjax('$routeDelete')";
                    $buttonDetail = '<button class="btn btn-sm btn-warning" onclick="window.location.href=\'' . "$routeDetail'\">" . '<i class="fas fa-comment-dots"> Feedback</i>' . '</button>';
                    $buttonDelete = '<button class="btn btn-sm btn-danger btn-delete" onclick="' . "$deleteAjax\">" . ' <i class="fas fa-trash"> Delete </i>' . '</button>';
                    $element = '<div class="d-flex justify-content-around" >' . $buttonDetail . $buttonDelete . '</div>';
                    return $element;
                })
                ->rawColumns(['deleteMany', 'action', 'status'])
                ->make(true);
        }
        return view('admin.contact.index', [
            'title' => self::TITLE,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = ContactModel::findOrFail($id);
        return view('admin.contact.show', [
            'contact' => $contact,
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
        $contactModel = ContactModel::find($id);
        if ($contactModel->update($request->all())) {
            $href = route('contact.index');
            return response()->json([
                'success' => ['href' => "$href"],
            ]);
        }
    }

    public function feedback(Request $request, $id)
    {
        $request->validate(
            [
                'feedback' => 'required',
            ],
            [
                'required' => 'Trường này không được bỏ trống!',
            ],
        );
        $contactModel = ContactModel::find($id);
        $contacts = [
            'feedback' => $request->feedback,
            'contact' => $contactModel,
        ];
        $mail = Mail::send('admin.contact.mail', ['contacts' => $contacts], function ($message) {
            $message->to('phuocbt698@gmail.com', 'PhuocBt');
            $message->replyTo('john@johndoe.com', 'John Doe');
            $message->subject('Phản hồi từ webthucpham');
        });
        if ($mail) {
            if ($contactModel->update(['status' => 1])) {
                $href = route('contact.index');
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
        $delete = ContactModel::destroy($id);
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
        $delete = ContactModel::destroy($listID);
        if ($delete) {
            return response()->json(['statusCode' => 200]);
        } else {
            return response()->json(['statusCode' => 400]);
        }
    }
}
