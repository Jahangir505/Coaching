@extends('admin.master')

@section('content')
    <!--Content Start-->
<section class="container-fluid">
    <div class="row content">
        <div class="col-12 pl-0 pr-0">
            <div class="form-group">
            @include('admin.includes.alert')
                <div class="col-sm-12">
                    {{-- <h4 class="text-center font-weight-bold font-italic mt-3">{{$students[0]->student_name}}'s profile</h4> --}}
                </div>
                <div class="row ml-0 mr-0">
                    <div class="col-3">
                     <h4 style="text-align: center;padding-top: 10px;">Profile of <em>{{$students[0]->student_name}}</em></h4>
                    @if(isset($students[0]->student_photo))
                        <img src="{{ asset($students[0]->student_photo)}}" class="img-thumbnail" alt="Profile Picture">
                    @else
                        <img src="{{ asset('/admin/assets/images/avatar.png') }}" class="img-thumbnail" alt="Profile Picture" style="width:100%;">
                    @endif
                        <hr>
                        <table>
                            <tr>
                                <td>
                                    <button data-toggle="modal" data-target="#studentBasicInfoUpdate" class="btn btn-block my-btn-submit">Edit Profile</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-9">
                        @include('admin/student/details/basic-info')
                    </div>
                </div>
            </div>
            

            
        </div>
    </div>
</section>
<!--Content End-->

{{-- Modal --}}

@include('admin/includes/modal/basic-info-update')
@endsection