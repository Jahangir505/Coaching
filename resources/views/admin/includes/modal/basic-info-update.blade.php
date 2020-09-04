 
      <!-- Modal -->
      <div class="modal fade bd-example-modal-lg" id="studentBasicInfoUpdate" tabindex="-1" role="dialog" aria-labelledby="studentBasicInfoUpdate" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="studentBasicInfoUpdate">Student Basic Info Update</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{-- {{ route('student-type-update')}} --}}" method="POST" id="studentBasicInfoUpdate">
                @csrf
                <div class="modal-body">
                    
                   {{--  <div class="form-group row ">
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
                    </div> --}}
                                        
                    <div class="form-group row ">
                        <label for="studentType" class="col-form-label col-sm-3 text-right">Student Type</label>
                            <div class="col-sm-9">
                                {{-- <input type="text" class="form-control @error('student_type') is-invalid @enderror" name="student_type" value="{{ old('student_type') }}" id="studentType" placeholder="Write Student type" required>
                                                    @error('student_type')
                                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror --}}
                            </div>
                    </div>

                    <input type="hidden" name="type_id" id="typeID" />
                
                    
                </div>

        
                <div class="modal-footer">
                <button type="reset" class=" d-none" data-dismiss="modal">Reset</button>
                <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
          </div>
        </div>
      </div>