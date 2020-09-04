 
 			<div class="form-group col-md-6 mb-3">
               <label for="classId" class="col-sm-4 col-form-label text-right">Class Name</label>
                <select name="class_id" class="form-control col-sm-8" id="classId" required>
                        <option value="">Select Class</option>
                        @foreach($class as$clas)
                            <option value="{{$clas->id}}" {{ $clas->id == $request->class_id ? 'selected': '' }}>{{$clas->class_name}}</option>
                        @endforeach
                </select>
                    <span class="text-danger"></span>
            </div>

            <div class="form-group col-md-6 mb-3">
                <label class="col-sm-4 col-form-label text-right">Student Type</label>
                <div class="col-sm-8" id="type">
                	

					 @if(count($types)>0)

					 	@foreach($types as $type)

					 		<input type="checkbox"  name="student_type[{{ $type->id}}]" id="studentType-{{$type->id}}" value="{{ $type->id}}" class="mr-2" /> {{$type->student_type}}

					 	@endforeach

					 @else

					 	<span class="text-danger">Please Add Some type First</span>

					 @endif
                </div>
                       
            </div>




@foreach($types as $type)
	<div class="col-12" id="batchRollInfo-{{$type->id}}"></div>
@endforeach

 <script>

 	@foreach($types as $type)
		$('#studentType-{{$type->id}}').change(function(){
			var typeID = $(this).val();
			if($(this).prop('checked')){
				var classId = $('#classId').val();
				
		 		if(classId && typeID){
		 			$.get("{{ route('batch-roll-form') }}",{
		 				class_id:classId,
		 				type_id:typeID
		 			},function(data){
		 				$('#batchRollInfo-'+typeID).empty().html(data);
		 			});
		 		}
			}else{
				$('#batchRollInfo-'+typeID).empty();
			}
		})
	@endforeach

 	// function batchRollFrom(typeID){
 	// 	var classId = $('#classId').val();

 	// 	if(classId && typeID){
 	// 		$.get("{{ route('batch-roll-form') }}",{
 	// 			class_id:classId,
 	// 			type_id:typeID
 	// 		},function(data){
 	// 			$('#batchRollInfo-'+typeID).empty().html(data)
 	// 		});
 	// 	}
 	// }

 	$('#classId').change(function(){
            var class_id = $(this).val();

            if(class_id){
                $.get("{{ route('bring-student-type')}}",{
                    class_id:class_id
                },function(data){
                    console.log(data);
                    $('#batchInfo').empty().html(data); 
                })
            }
        });
 </script>
