@extends('admin.master')

@section('content')
    <!--Content Start-->
<section class="container-fluid">
    <div class="row content">
        <div class="col-12 pl-0 pr-0">
        @include('admin.includes.alert')

            <div class="form-group">
                <div class="col-sm-12">
                    <h4 class="text-center font-weight-bold font-italic mt-3">Class Selection Form</h4>
                </div>

                <div class="row ml-0 mr-0">
                    <div class="col">
                        <select name="class_id" id="classId" class="form-control">
                            <option value="">---Select Class---</option>
                            @foreach($classes as $class)
                                <option value="{{$class->id}}">{{$class->class_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <select name="type_id" id="typeId" class="form-control">
                            <option value="">---Select Type---</option>
                            
                        </select>
                    </div>
                </div>

                  <div class="row ml-0 mr-0">
                    <div class="col" id="studentList">
                        
                    </div>
                   
                </div>

            </div>
            

            
        </div>
    </div>
</section>
<!--Content End-->
    @include('admin.includes.loader')

    <style>
        #overlay .loader{display: none;}
    </style>

    <script>
        $('#classId').change(function(){
            var classId = $(this).val();
            if(classId){
                $('#overlay .loader').show();
                $.get("{{ route('class-wise-student-type')}}",{class_id:classId},function(data){
                    console.log(data);
                    $('#typeId').empty().html(data);
                    $('#overlay .loader').hide();
                })
            }
        })

        $('#typeId').change(function(){
            var classId = $('#classId').val();
            var typeId = $(this).val();
            if(classId && typeId){
                $('#overlay .loader').show();
                $.get("{{ route('class-and-type-wise-student')}}",{
                    class_id:classId,
                    type_id:typeId,

                },function(data){
                    console.log(data);
                    $('#studentList').empty().html(data);
                    $('#overlay .loader').hide();
                })
            }
        })
    </script>

@endsection