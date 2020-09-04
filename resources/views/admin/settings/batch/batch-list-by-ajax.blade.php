
 @if(Session::get('msg'))
 <div class="alert alert-success alert-dismissible fade show" role="alert">
     <strong>Message : </strong> {{ Session::get('msg') }}
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
     </button>
 </div>
@endif


<thead>
    <tr>
        <th>Sl.</th>
        <th>Batch Name</th>
        <th>Student Capacity</th>
        <th>Action</th>
    </tr>
</thead>

<tbody>
    @php($i=1)
    @foreach($batches as $batch)

    <tr>
        <td>{{ $i++}}</td>
        <td>{{ $batch->batch_name}}</td>
        <td>{{ $batch->stu_cap}}</td>
        <td>
                @if($batch->status == 1 )
                 <button onclick="unpublished('{{ $batch->id}}','{{ $batch->class_id }}')" title="Unpublished" class="btn btn-sm btn-success"><span class="fa fa-arrow-alt-circle-up"></span></button>
                @else
                 <button onclick="published('{{ $batch->id}}','{{ $batch->class_id }}')" title="Published" class="btn btn-sm btn-warning"><span class="fa fa-arrow-alt-circle-down"></span></button>
                @endif
                 <a href="{{ route('batch-edit',['id'=>$batch->id])}}" class="btn btn-sm btn-info"><span class="fa fa-edit"></span></a>
                 <button onclick="delt('{{ $batch->id}}','{{ $batch->class_id }}')"  onclick="return confirm('If you want to delete this item press Ok')" class="btn btn-sm btn-danger"><span class="fa fa-trash-alt"></span></button>
            </td>
    </tr>

    @endforeach
</tbody>


<script>
    function unpublished(batchId, classId){
      var check =  confirm('Are you sure Want to Unpublished? Press Ok');
      if(check){
        $.get("{{ route('batch-unpublished') }}", {batch_id:batchId,class_id:classId}, function(data){
                   console.log(data);
                    $('#batchList').html(data);
                })
      }
    }

    function published(batchId, classId){
      var check =  confirm('Are you sure Want to  Published? Press Ok');
      if(check){
        $.get("{{ route('batch-published') }}", {batch_id:batchId,class_id:classId}, function(data){
                   console.log(data);
                    $('#batchList').html(data);
                })
      }
    }


    function delt(batchId, classId){
      var check =  confirm('Are you sure Want to  Published? Press Ok');
      if(check){
        $.get("{{ route('batch-delete') }}", {batch_id:batchId,class_id:classId}, function(data){
                   console.log(data);
                    $('#batchList').html(data);
                })
      }
    }


</script>