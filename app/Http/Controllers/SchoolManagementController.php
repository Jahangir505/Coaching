<?php

namespace App\Http\Controllers;

use App\School;
use Illuminate\Http\Request;

class SchoolManagementController extends Controller
{
    public function addSchool(){
        return view('admin.settings.school.add-form');
    }

    public function schoolSave(Request $request){
        $this->validate($request,[
            'school_name' => 'required|string'
        ]);

        $data = new School();
        $data->school_name = $request->school_name;
        $data->status = 1;
        $data->save();

        return back()->with('msg','School Added Successfully');
    }

    public function schoolList(){
        $school = School::all();
        return view('admin.settings.school.school-list',compact('school'));
    }


    public function schoolUnpublished($id){
        $school = School::find($id);
        $school->status = 2;
        $school->save();
        return redirect('/school/list')->with('msg','School Unpublished Successfully');
    }

    public function schoolPublished($id){
        $school = School::find($id);
        $school->status = 1;
        $school->save();
        return redirect('/school/list')->with('msg','School Published Successfully');
    }

    public function schoolEdit($id){
        $school = School::find($id);
        return view('admin.settings.school.school-edit',compact('school'));
    }

    public function schoolUpdate(Request $request){
        $this->validate($request,[
            'school_name' => 'required|string'
        ]);

        $school = School::find($request->school_id);
        $school->school_name = $request->school_name;
        $school->save();

        return redirect('/school/list')->with('msg','School Name Update Successfully');
    }

    public function schoolDelete($id){
        $school = School::find($id);
        $school->delete();

        return redirect('/school/list')->with('msg','School Deleted Successfully');
    }
}
