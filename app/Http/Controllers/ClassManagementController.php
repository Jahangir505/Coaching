<?php

namespace App\Http\Controllers;

use App\ClassName;
use Illuminate\Http\Request;

class ClassManagementController extends Controller
{
    public function addClass(){
        return view('admin.settings.class.add-form');
    }

    public function classSave(Request $request){
        $this->validate($request,[
            'class_name' => 'required|string'
        ]);

        $data = new ClassName();
        $data->class_name = $request->class_name;
        $data->status = 1;
        $data->save();

        return back()->with('msg','Class Added Successfully');
    }

    public function classList(){
        $class = ClassName::all();
        return view('admin.settings.class.class-list',compact('class'));
    }


    public function classUnpublished($id){
        $class = ClassName::find($id);
        $class->status = 2;
        $class->save();
        return redirect('/class/list')->with('msg','Class Unpublished Successfully');
    }

    public function classPublished($id){
        $class = ClassName::find($id);
        $class->status = 1;
        $class->save();
        return redirect('/class/list')->with('msg','Class Published Successfully');
    }

    public function classEdit($id){
        $class = ClassName::find($id);
        return view('admin.settings.class.class-edit',compact('class'));
    }

    public function classUpdate(Request $request){
        $this->validate($request,[
            'class_name' => 'required|string'
        ]);

        $class = ClassName::find($request->class_id);
        $class->class_name = $request->class_name;
        $class->save();

        return redirect('/class/list')->with('msg','Class Name Update Successfully');
    }

    public function classDelete($id){
        $class = ClassName::find($id);
        $class->delete();

        return redirect('/class/list')->with('msg','Class Deleted Successfully');
    }
}
