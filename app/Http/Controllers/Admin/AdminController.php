<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;


class AdminController extends Controller
{

    public function __construct()
    {

    }


    public function index()
    {
        $admins = Admin::count();
        return view('admin.home.dashboard',[
            'admins'=>$admins,
            'users'=>User::count(),
        ]);
    }//end fun


    public function calender(Request $request)
    {
        $arrResult =[];
        $users = User::get();
        //get count of orders by days
        foreach ($users as $row) {
            $date = date('Y-m-d', strtotime($row->created_at));
            if (isset($arrResult[$date])) {
                $arrResult[$date]["counter"] += 1;
                $arrResult[$date]["id"][]  = $row->id;
            } else {
                $arrResult[$date]["counter"] = 1;
                $arrResult[$date]["id"][]  = $row->id;

            }
        }
      //  dd($arrResult);
        //make format of calender
        $Events = [];
        if (count($arrResult)>0) {
            $i = 0;
            foreach ($arrResult as $item => $value) {
                $title= $value['counter'];
                $Events[$i] = array(
                    'id' => $i,
                    'title' => $title,
                    'start' => $item,
                    'ids' => $value['id'],
                );
                $i++;
            }
        }
        //return to calender
        return $Events ;
    }//end fun


//    public function getCompaniesDetails(Request $request)
//    {
//        $ids = explode(',',$request->ids);
//        $companies = User::whereIn('id',$ids)->get();
//        return redirect()->route('companies.index')->with([
//            'ids'=>$ids
//        ]);
//    }//end fun


}//end
