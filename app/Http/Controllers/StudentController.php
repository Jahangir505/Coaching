<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\School;
use App\ClassName;
use App\StudentType;
use App\Batch;
use App\Student;
use App\StudentTypeDetail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use DB;


class StudentController extends Controller
{
    public function studentRegistrationForm(){
    	$schools = School::where('status','=',1)->get();
    	$class = ClassName::where('status','=',1)->get();
    	return view('admin.student.registration-form',compact('schools','class'));
    }

    public function bringStudentType(Request $request){
    	$types = StudentType::where('class_id','=',$request->class_id)->get();
    	$class = ClassName::where('status','=',1)->get();

    	return view('admin.student.stydent-types',compact('types','class','request'));
    }

    public function batchRollForm(Request $request){
    	$batches = Batch::where([
    			'class_id' => $request->class_id,
    			'student_type_id'  => $request->type_id
    		])->get();
    	$type = StudentType::find($request->type_id);

    	//return $batches;
    	return view('admin.student.batch-roll-form',compact('batches','type'));
    }


    public function studentSave(Request $request){
    	$student = new Student();

    	$student->student_name = $request->student_name;
    	$student->school_id = $request->school_id;
    	$student->class_id = $request->class_id;
    	$student->father_name = $request->father_name;
    	$student->father_mobile = $request->father_mobile;
    	$student->father_profession = $request->father_profession;
    	$student->mother_name = $request->mother_name;
    	$student->mother_mobile = $request->mother_mobile;
    	$student->mother_profession = $request->mother_profession;
    	$student->email_address = $request->email_address;
    	$student->sms_mobile = $request->sms_mobile;
    	$student->date_of_admission = $request->date_of_admission;
    	//$student->student_photo = $request->student_photo; // to be edited
    	$student->address = $request->address;
    	$student->status = 1;
    	$student->password = $request->sms_mobile;
    	$student->encrypted_password = Hash::make($request->sms_mobile);
    	$student->user_id = Auth::user()->id;
    	$student->save();

    	$studentID = $student->id;
    	$batches = $request->batch_id;
    	$rollNumber = $request->roll;

    	$studentTypes = $request->student_type;
    	foreach ($studentTypes as $key => $studentType) {
    		$data = new StudentTypeDetail();

    		$data->student_id = $studentID;
    		$data->class_id = $request->class_id;
    		$data->type_id = $key;
    		$data->batch_id = $batches[$key];
    		$data->roll_no = $rollNumber[$key];
    		$data->type_status = 1;
    		$data->save();
    	}

    	return back()->with('msg','registration Succesfully');

    }


    public function allRuningStudentList(){
    	$students = DB::table('students')
    	->join('schools','students.school_id','=','schools.id')
    	->join('class_names','students.class_id','=','class_names.id')
    	->select('students.*','schools.school_name','class_names.class_name')
    	->where([
    		'students.status'=>1
    		])->orderBy('students.class_id','ASC')->get();

    	return view('admin.student.all-runing-students',compact('students'));
    }


    public function classSelectionForm(){
    	$classes = ClassName::where('status',1)->get();
    	return view('admin.student.class.class-selection-form',compact('classes'));
    }


    public function classWiseStudentType(Request $request){
    	$classId = $request->class_id;
    	$types = StudentType::where([
    		'class_id'=>$classId,
    		'status' => 1
    		])->get();

    	return view('admin.student.class.student-type',compact('types'));
    }


    public function classAndTypeWiseStudent(Request $request){
    	$students = DB::table('students')
    	->join('schools','students.school_id','=','schools.id')
    	->join('student_type_details','student_type_details.student_id','=','students.id')
    	->join('batches','student_type_details.batch_id','=','batches.id')
    	->select('students.*','schools.school_name','student_type_details.roll_no','batches.batch_name')
    	->where([
    		'students.status'=>1,
    		'students.class_id'=>$request->class_id,
    		'student_type_details.type_id'=>$request->type_id,
    		'student_type_details.type_status'=>1
    		
    		])->orderBy('student_type_details.roll_no','ASC')->get();

    	return view('admin.student.class.student-list',compact('students'));

    }

    public function studentDetails($id){

    	$students = $this->getSingleStudent($id);

    	//return $students;
    	return view('admin.student.details.profile',compact('students'));
    }


    protected function getSingleStudent($id){
    	$students = DB::table('students')
    	->join('schools','students.school_id','=','schools.id')
    	->join('class_names','students.class_id','=','class_names.id')
    	->join('student_type_details','student_type_details.student_id','=','students.id')
    	->join('student_types','student_type_details.type_id','=','student_types.id')
    	->join('batches','student_type_details.batch_id','=','batches.id')
    	->select('students.*','schools.school_name','student_type_details.roll_no','batches.batch_name','class_names.class_name','student_types.student_type')
    	->where([
    		'students.status'=>1,
    		'students.id'=>$id,
    		
    		])->orderBy('student_type_details.type_id','ASC')->get();

    	return $students;
    }


}
