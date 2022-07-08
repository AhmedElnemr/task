<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Upload_Files;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    use Upload_Files;

    public function __construct()
    {
        /* $this->middleware([('permission:settings index,admin')])->only(['index']);*/
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $settings = Setting::firstOrNew();
        return view('admin.settings.index',[
            'settings'=>$settings
        ]);
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
    public function edit(Request $request)
    {


    }

    /**
     * @param Request $request
     * @param Setting $setting
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request,$id)
    {
        $setting = Setting::findOrFail($id);
       $data = $request->all();
       if ($request->hasFile('header_logo'))
           $data['header_logo']= $request->hasFile('header_logo')
               ?$this->uploadFiles('settings',$request->header_logo,$setting->header_logo)
               :$setting->header_logo;

        if ($request->hasFile('footer_logo'))
            $data['footer_logo']= $request->hasFile('footer_logo')
                ?$this->uploadFiles('settings',$request->footer_logo,$setting->footer_logo)
                :$setting->footer_logo;

        Setting::updateOrCreate(['id' => 1],$data);
       $settings = Setting::first();
        return response()->json(['settings'=>$settings,'logo'=>get_file($settings->header_logo)],200);
    }//end fun


    /**
     * @param $id
     */
    public function destroy($id)
    {

    }//end fun
}//end class
