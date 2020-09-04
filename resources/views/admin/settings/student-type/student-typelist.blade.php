@extends('admin.master')

@section('content')
    <!--Content Start-->
<section class="container-fluid">
    <div class="row content">
        <div class="col-12 pl-0 pr-0">
            <div class="form-group">
                <div class="col-sm-12">
                    <h4 class="text-center font-weight-bold font-italic mt-3">Student type <button class=" bg-success text-light" data-toggle="modal" data-target="#studentType">Add New<button></h4>
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
                        <th>Class Name</th>
                        <th>Student Types </th>
                        <th>Status</th>
                        <th style="width: 100px;">Action</th>
                    </tr>
                    </thead>
                    <tbody id="studentTypeTable">

                       @include('admin.settings.student-type.student-type-table')
                
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!--Content End-->



<!-- Button trigger modal -->

     @include('admin.settings.student-type.modal.add-form')
     @include('admin.settings.student-type.modal.edit-form')

      <script>
          $('#studentTypeInsert').submit(function(e){
              e.preventDefault();
              var url = $(this).attr('action');
              var data = $(this).serialize();
              var method = $(this).attr('method');
              $('#studentType #reset').click();
              $('#studentType').modal('hide');

              $.ajax({
                  data : data,
                  type : method,
                  url : url,
                  success : function(){
                      $.get("{{ route('student-tyoe-list' ) }}", function(data){
                        $('#studentTypeTable').empty().html(data);
                      } )
                  }
              })
          });

           function studentTypeUnpublished(id){
                $.get("{{ route('student-type-un-publish')}}",{ type_id:id}, function(data){
                    //console.log(data);
                    $('#studentTypeTable').empty().html(data);
                });
            }

           function studentTypePublished(id){
                $.get("{{ route('student-type-publish')}}",{ type_id:id}, function(data){
                    //console.log(data);
                    $('#studentTypeTable').empty().html(data);
                });
            }


            function studentTypeEdit(id,name){

              $('#studentTypeEdit').find('#studentType').val(name);
              $('#studentTypeEdit').find('#typeID').val(id);
              $('#studentTypeEdit').modal('show');
            }


            $('#studentTypeUpdate').submit(function(e){
              e.preventDefault();
              var url = $(this).attr('action');
              var data = $(this).serialize();
              var method = $(this).attr('method');
              $('#studentTypeEdit #reset').click();
              $('#studentTypeEdit').modal('hide');

              $.ajax({
                  data : data,
                  type : method,
                  url : url,
                  success : function(data){
                      $('#studentTypeTable').empty().html(data);
                  }
              })
            })


            function studentTypeDelete(id){
              var msg = 'If you want to delete this item Press Ok';
              if(confirm(msg)){
                 $.get("{{ route('student-type-delete')}}",{ type_id:id}, function(data){
                    //console.log(data);
                    $('#studentTypeTable').empty().html(data);
                });
              }
            }

      </script>


@endsection