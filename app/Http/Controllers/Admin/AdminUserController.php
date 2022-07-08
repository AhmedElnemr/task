<?php

namespace App\Http\Controllers\Admin;

use App\Http\Traits\CheckPermission;
use App\Http\Traits\Upload_Files;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;


class AdminUserController extends Controller
{

    use Upload_Files, CheckPermission;


    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $users = User::query()->latest();
            return DataTables::of($users)
                ->editColumn('is_verified', function ($user) {
                    $re_block = '';
                    if ($user->is_verified) {
                        $re_block = '<span class=" badge bg-primary">' . trans('admin.active') . '</span>';
                    } else {
                        $re_block = '<span class="badge bg-danger">' . trans('admin.not_active') . '</span>';
                    }
                    return $re_block;
                })
                ->editColumn('created_at', function ($user) {
                    return date('Y/m/d', strtotime($user->created_at));
                })
                ->addColumn('delete_all', function ($row) {
                    return "<input type='checkbox' class=' delete-all form-check-input' data-tablesaw-checkall name='delete_all' id='" . $row->id . "'>";
                })
                ->addColumn('actions', function ($user) {
                    return "
                    <button  class='btn btn-info editButton' id='" . $user->id . "'> <i class='fa fa-edit'></i></button>
                    <button title='يمكنك التنشيط أو  الغاء التنشيط من هنا'
                    class='btn btn-info status' id='" . $user->id . "'> <span class='fa fa-user-clock'></span></button>
                   <button class='btn btn-danger  delete' id='" . $user->id . "'><span class='fa fa-trash'></span> </button>";
                })
                ->rawColumns(['actions', 'is_verified', 'delete_all', 'created_at', 'is_verified'])->make(true);
        }
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->ajax()) {
            $returnHTML = view("admin.users.parts.add_form")->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'username' => ['required', 'string', 'max:255'], //  required | string|max:255
            'phone_number' => ['required', 'numeric', 'unique:users'], //  required | numeric | unique
            'password' => ['required', 'string', 'min:6'],// required | string | min:6
        ]);
        $data = $request->only(['username', 'phone_number', 'password']);
        $data['password'] = Hash::make($request->password);
        $data['is_verified'] = 1;
        $user = User::create($data);
        return response()->json(1, 200);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {

        if ($request->ajax()) {
            $returnHTML = view("admin.users.parts.edit_form")
                ->with([
                    'user' => User::findOrFail($id),
                ])
                ->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $this->validate($request, [
            'username' => ['required', 'string', 'max:255'], //  required | string|max:255
            'phone_number' => ['required', 'numeric'], //  required | numeric | unique
            'password' => ['nullable'], //  required | numeric | unique
        ]);
        $user->update($data);
        return response()->json(1, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json(User::destroy($id), 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function delete_all(Request $request)
    {

        User::destroy($request->id);
        return response()->json(1, 200);
    }


    public function changeBlock($id)
    {
        $row = User::findOrFail($id);
        $status = $row->is_verified == 1 ? 0 : 1;
        $row->update(['is_verified' => $status]);
        return response()->json(1, 200);
    }


}//end
