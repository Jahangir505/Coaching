@extends('admin.master')
@section('content')
    <!--Content Start-->
    <section class="container-fluid">
        <div class="row content">
            <div class="col-md-12 pl-0 pr-0">

                @if(Session::get('msg'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Message : </strong> {{ Session::get('msg') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="form-group">
                    <div class="col-sm-12">
                        <h4 class="text-center font-weight-bold font-italic mt-3">Class Wise Batch List</h4>
                    </div>
                </div>

                    <div class="table-responsive p-1">
                        <table id="" class="table table-bordered dt-responsive nowrap text-center" style="width: 100%;">
                            
                           
                                <tr>
                                        <td>
                                           <div class="row">
                                               <div class="col-md">
                                                    <div class="form-group row mb-0">
                                                        <label for="classID" class="col-form-label col-sm-3 text-right">CLass Name</label>
                                                        <div class="col-sm-9">
                                                            <select name="class_id" class="form-control @error('class_id') is-invalid @enderror" id="classID" required autofocus>
                                                                <option value="">Select Class</option>
                                                                @foreach($classes as $class)
                                                                    <option value="{{ $class->id}}">{{$class->class_name}}</option>
                                                                @endforeach
                                                            </select>
                                                             @error('class_id')
                                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                               </div>
                                               <div class="col-md">
                                                    <div class="form-group row mb-0">
                                                        <label for="typeID" class="col-form-label col-sm-3 text-right">Student Type</label>
                                                        <div class="col-sm-9">
                                                            <select name="type_id" class="form-control @error('type_id') is-invalid @enderror" id="typeID" required>
                                                                <option value="">Select Course</option>
                                                                
                                                            </select>
                                                             @error('type_id')
                                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                               </div>
                                           </div>
                                        </td>
                                 </tr>

                        </table>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-center" id="batchList">

                        </table>
                    </div>

            </div>
        </div>
    </section>
    <!--Content End-->
    <style>#overlay .loader{display: none}</style>
    @include('admin.includes.loader')


    <script>
        $('#classID').change(function(){
            
            var classID = $(this).val();
            if(classID){
                $('#overlay .loader').show();
                $.get('{{ route("class-wise-student-type")}}',{ class_id:classID }, function(data){
                    $('#overlay .loader').hide();
                    console.log(data);
                    $('#typeID').empty().html(data);
                });
            }
        })
        $('#typeID').change(function (){
            var studentTypeId = $(this).val();
            var classId = $('#classID').val();

            if(classId && studentTypeId){
                $('#overlay .loader').show();
                $.get("{{ route('batch-list-by-ajax') }}", {
                    class_id:classId,
                    type_id:studentTypeId
                }, function(data){
                    $('#overlay .loader').hide();
                    $('#batchList').html(data);
                })
            } else{
                $('#batchList').empty();
            }
        })
    </script>

@endsection
