@extends('admin.master')

@section('content')
    <!--Content Start-->
<section class="container-fluid">
    <div class="row content">
        <div class="col-12 pl-0 pr-0">
            <div class="form-group">
                <div class="col-sm-12">
                    <h4 class="text-center font-weight-bold font-italic mt-3">School List</h4>
                </div>
            </div>

            @if(Session::get('msg'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Message:</strong> {{ Session::get('msg') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
            @endif

            @if(Session::get('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Message:</strong> {{ Session::get('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
            @endif

            <div class="table-responsive p-1">
                <table id="example" class="table table-striped table-bordered dt-responsive nowrap text-center" style="width: 100%;">
                    <thead>
                    <tr>
                        <th>Sl.</th>
                        <th>School Name</th>
                        <th>Status</th>
                        <th style="width: 100px;">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($school as $sch)
                            <tr>
                                <td>{{$sch->id}}</td>
                                <td>{{$sch->school_name}}</td>
                                <td>{{$sch->status == 1 ? 'Published' : 'Not-Published'}}</td>
                                <td>
                                    @if($sch->status == 1 )
                                     <a href="{{ route('school-unpublished',['id'=>$sch->id])}}" title="Unpublished" class="btn btn-sm btn-success"><span class="fa fa-arrow-alt-circle-up"></span></a>
                                    @else
                                     <a href="{{ route('school-published',['id'=>$sch->id])}}" title="Published" class="btn btn-sm btn-warning"><span class="fa fa-arrow-alt-circle-down"></span></a>
                                    @endif
                                     <a href="{{ route('school-edit',['id'=>$sch->id])}}" class="btn btn-sm btn-info"><span class="fa fa-edit"></span></a>
                                     <a href="{{route('school-delete',['id'=>$sch->id])}}" onclick="return confirm('If you want to delete this item press Ok')" class="btn btn-sm btn-danger"><span class="fa fa-trash-alt"></span></a>
                                </td>
                            </tr>
                        @endforeach
                
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!--Content End-->
@endsection