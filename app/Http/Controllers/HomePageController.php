<?php

namespace App\Http\Controllers;

use App\HeaderFooter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomePageController extends Controller
{
    public function addHeaderFooter(){
        $headerFooter = DB::table('header_footers')->first();

        if(isset($headerFooter)){
            return view('admin.home.manage-header-footer',compact('headerFooter'));
        }else{
            return view('admin.home.add-header-footer-form');
        }

        
    }

    public function headerAndFooterSave(Request $request){
        $this->headerFooterValidation($request);
        
        $data = new HeaderFooter();
        $data->owner_name = $request->owner_name;
        $data->department = $request->department;
        $data->address    = $request->address;
        $data->mobile     = $request->mobile;
        $data->copyright  = $request->copyright;
        $data->status     = $request->status;
        $data->save();

        return redirect('/home')->with('msg','Header and Footer Added Successfully');
    }

    public function manageHeaderFooter($id){
        $headerFooter = HeaderFooter::find($id);

        return view('admin.home.manage-header-footer',compact('headerFooter'));
    }

    public function headerAndFooterUpdate(Request $request){
        $this->headerFooterValidation($request);

        $headerFooter = HeaderFooter::find($request->id);
        $headerFooter->owner_name = $request->owner_name;
        $headerFooter->department = $request->department;
        $headerFooter->address    = $request->address;
        $headerFooter->mobile     = $request->mobile;
        $headerFooter->copyright  = $request->copyright;
        $headerFooter->save();
        return redirect('/home')->with('msg','Header and Footer Update Successfully');
    }

    public function headerFooterValidation($request){
        $this->validate($request,[
            'owner_name'   => 'required',
            'department'   => 'required',
            'address'      => 'required',
            'mobile'       => 'required',
            'mobile'       => 'required',
            'copyright'    => 'required',
        ]);
    }

}
