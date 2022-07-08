<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Http\Traits\Upload_Files;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminProfileController extends Controller
{
    use Upload_Files;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function edit($id,Request $request)
    {
        if ($request->ajax()){
            $returnHTML = view("admin.profile.edit")
                ->with([
                  'admin'=>admin()->user()
                ])
                ->render();
            return response()->json(array('success' => true, 'html'=>$returnHTML));
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
        //log activities
        $admin = Admin::findOrFail($id);

        $data = $this->validate($request,[
            'name'=>'required',
            'email'=>Rule::unique('admins')->ignore($id),
            'password'=>'nullable',
            'image'=>'nullable',
        ]);

        if ($request->password)
            $data['password'] = bcrypt($request->password);
        else
            $data['password'] = $admin->password;


        if ($request->hasFile('image'))
            $data ['image'] = $this->uploadFiles('admins',$request->file('image'),$admin->image );
        else
            $data ['image'] = $admin->image;

        $admin->update($data);
        $admin = Admin::findOrFail($id);

        return response()->json(['logo'=>get_file($admin->image),"name"=>$admin->name],200);
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
