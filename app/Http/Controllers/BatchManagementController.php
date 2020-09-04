<?php

namespace App\Http\Controllers;

use App\Batch;
use App\ClassName;
use App\StudentType;
use Illuminate\Http\Request;

class BatchManagementController extends Controller
{
    public function addBatch(){
        $classes = ClassName::all();

        return view('admin.settings.batch.add-form',compact('classes'));
    }

     public function classWiseStudentType(Request $request){
       $types = StudentType::where([
            'class_id' => $request->class_id
        ])->get();
       return view('admin.settings.batch.class-wise-student-type',compact('types')); 
    }



    public function batchSave(Request $request){
        $this->validate($request,[
            'class_id' => 'required',
            'type_id' => 'required',
            'batch_name' => 'required|string',
            'stu_cap'   =>  'required'
        ]);

        $data = new Batch();
        $data->class_id = $request->class_id;
        $data->student_type_id = $request->type_id;
        $data->batch_name = $request->batch_name;
        $data->status = 1;
        $data->stu_cap = $request->stu_cap;
        $data->save();

        return back()->with('msg','Batch Added Succssfully');
    }


    public function batchList(){
        $classes = ClassName::all();


        return view('admin.settings.batch.batch-list',compact('classes'));
    }

    public function batchListByAjax(Request $request){
        $batches = Batch::where([
            'class_id'=>$request->class_id,
            'student_type_id'=>$request->type_id,
            ])->where('status','!=',3)->get();

        if(count($batches)>0){
            return view('admin.settings.batch.batch-list-by-ajax',compact('batches'));
        }else{
            return view('admin.settings.batch.batch-empty-error'); 
        }
        
    }

    public function batchUnpublished(Request $request){
        $batch = Batch::find($request->batch_id);
        $batch->status = 2;
        $batch->save();

        $batches = Batch::where(['class_id'=>$request->class_id])->get();
        return view('admin.settings.batch.batch-list-by-ajax',compact('batches'))->with('msg', 'Batch Unpublished Successfully');
    }

    public function batchPublished(Request $request){
        $batch = Batch::find($request->batch_id);
        $batch->status = 1;
        $batch->save();

        $batches = Batch::where(['class_id'=>$request->class_id])->get();
        return view('admin.settings.batch.batch-list-by-ajax',compact('batches'))->with('msg', 'Batch Published Successfully');
    }


    public function batchEdit($id){
        $batch = Batch::find($id);
        $classes = ClassName::all();

        return view('admin.settings.batch.edit-batch',compact('batch','classes'));
    }

    public function batchUpdate(Request $request){
        $this->validate($request,[
            'class_id' => 'required',
            'batch_name' => 'required|string',
            'stu_cap'   =>  'required'
        ]);
        
        $data = Batch::find($request->batch_id);
        $data->class_id = $request->class_id;
        $data->batch_name = $request->batch_name;
        $data->status = 1;
        $data->stu_cap = $request->stu_cap;
        $data->save();

        return redirect('/batch/list')->with('msg','Batch Updated Succssfully');
    }



    public function batchDelete(Request $request){
        $batch = Batch::find($request->batch_id);
        $batch->delete();

        $batches = Batch::where(['class_id'=>$request->class_id])->get();

        if(count($batches)>0){   
            return view('admin.settings.batch.batch-list-by-ajax',compact('batches'))->with('msg', 'Batch Published Successfully');
        }else{
            return view('admin.settings.batch.batch-empty-error');
        }
        
    }




}
