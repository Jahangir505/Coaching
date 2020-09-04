@extends('admin.master')
@section('content')
    <!--Content Start-->
    <section class="container-fluid">
        <div class="row content">
            <div class="col-md-8 offset-md-2 pl-0 pr-0">

               @include('admin.includes.alert')

                <div class="form-group">
                    <div class="col-sm-12">
                        <h4 class="text-center font-weight-bold font-italic mt-3">Batch Add Form</h4>
                    </div>
                </div>

                <form action="{{ route('batch-save')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="table-responsive p-1">
                        <table id="" class="table table-bordered dt-responsive nowrap text-center" style="width: 100%;">
                            
                           
                                <tr>
                                        <td>
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
                                        </td>
                                 </tr>

                                 <tr>
                                        <td>
                                            <div class="form-group row mb-0">
                                                <label for="classID" class="col-form-label col-sm-3 text-right">Student Type</label>
                                                <div class="col-sm-9">
                                                    <select name="type_id" class="form-control @error('type_id') is-invalid @enderror" id="typeID" required>
                                                        <option value="">Select Type</option>
                                                       
                                                    </select>
                                                     @error('type_id')
                                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </td>
                                 </tr>

                            <tr>
                                <td>
                                    <div class="form-group row mb-0">
                                        <label for="batchName" class="col-form-label col-sm-3 text-right">Batch Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('batch_name') is-invalid @enderror" name="batch_name" value="{{ old('batch_name') }}" id="batchName" placeholder="Write Batch name" required>
                                            @error('batch_name')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                    <td>
                                        <div class="form-group row mb-0">
                                            <label for="stuCap" class="col-form-label col-sm-3 text-right">Student Capacity</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control @error('stu_cap') is-invalid @enderror" name="stu_cap" value="{{ old('stu_cap') }}" id="stuCap" placeholder="" required>
                                                @error('stu_cap')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>
                                    </td>
                                </tr>


                        

                            <tr><td><button type="submit" class="btn btn-block my-btn-submit">Save</button></td></tr>
                        </table>
                    </div>
                </form>
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
    </script>


@endsection
