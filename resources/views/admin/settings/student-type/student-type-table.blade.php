@if(count($studentTypes)>0)

@php($i=1)
@foreach ($studentTypes as $student)
    <tr>
        <td>{{ $i++ }}</td>
        <td>{{  $student->class_name }}</td>
        <td>{{  $student->student_type}}</td>
        <td>{{  $student->status == 1 ? 'Published' : 'Not-Published'}}</td>
        <td>
            @if($student->status == 1 )
             <button onclick="studentTypeUnpublished('{{ $student->id }}')" title="Unpublished" class="btn btn-sm btn-success"><span class="fa fa-arrow-alt-circle-up"></span></button>
            @else
             <button onclick="studentTypePublished('{{ $student->id }}')" title="Published" class="btn btn-sm btn-warning" title="Published"><span class="fa fa-arrow-alt-circle-down"></span></button>
            @endif
             <button onclick="studentTypeEdit('{{ $student->id }}','{{  $student->student_type}}')" class="btn btn-sm btn-info" title="Edit"><span class="fa fa-edit"></span></button>
             <button onclick="studentTypeDelete('{{ $student->id }}','{{  $student->student_type}}')"   class="btn btn-sm btn-danger" title="Delete"><span class="fa fa-trash-alt"></span></a>
        </td>
    </tr>
@endforeach
@else 
    <tr class="text-danger">
        <td colspan="5"><h2>Student type not found!</h2></td>
    </tr>
@endif

