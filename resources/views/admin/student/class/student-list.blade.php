


<div class="table-responsive p-1">
                <table id="example" class="table table-striped table-bordered dt-responsive  text-center" style="width: 100%;">
                    <thead>
                    <tr>
                        <th>Sl.</th>
                        <th>Name</th>
                        <th>School Name</th>
                        <th>Batch</th>
                        <th>Roll No</th>
                        <th>Father's Name</th>
                        <th>Father's Mobile</th>
                        <th>Mother's Mobile</th>
                        <th>Mother's Mobile</th>
                        <th>SMS Mobile</th>
                        <th>Student ID</th>
                        {{-- <th>Status</th> --}}
                        <th style="width: 100px;">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td>{{$student->id}}</td>
                                <td>{{$student->student_name}}</td>
                                <td>{{$student->school_name}}</td>
                                <td>{{$student->batch_name}}</td>
                                <td>{{$student->roll_no}}</td>
                                <td>{{$student->father_name}}</td>
                                <td>{{$student->father_mobile}}</td>
                                <td>{{$student->mother_name}}</td>
                                <td>{{$student->mother_mobile}}</td>
                                <td>{{$student->sms_mobile}}</td>
                                <td>{{$student->id}}</td>
                                {{-- <td><img src="{{asset('/')}}{{ $slide->slide_image}}" alt="" width="70"></td> --}}{{-- 
                                <td>{{$student->status == 1 ? 'Published' : 'Unpublished'}}</td> --}}
                                <td>
                                    @if($student->status == 1 )
                                     <a href="" title="Deactivate" class="btn btn-sm btn-success"><span class="fa fa-arrow-alt-circle-up"></span></a>
                                    @else
                                     <a href="" title="Activate" class="btn btn-sm btn-warning"><span class="fa fa-arrow-alt-circle-down"></span></a>
                                    @endif
                                     <a href="" class="btn btn-sm btn-info"><span class="fa fa-edit"></span></a>
                                     <a href="{{route('student-details',['id'=>$student->id])}}" class="btn btn-sm btn-info" title="Student Details"><span class="fa fa-eye"></span></a>
                                     <a href="" onclick="return confirm('If you want to delete this item press Ok')" class="btn btn-sm btn-danger"><span class="fa fa-trash-alt"></span></a>
                                </td>
                            </tr>
                        @endforeach
                
                    </tbody>
                </table>
            </div>



            <script>
            	//Data Table Start
				$(document).ready(function() {
				    $('#example').DataTable({
				        fixedHeader:true
				    });
				} );
				//Data Table End
            </script>

