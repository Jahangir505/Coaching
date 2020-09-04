@extends('admin.master')

@section('content')
    <!--Content Start-->
<section class="container-fluid">
        <div class="row content">
            <div class="col-12 pl-0 pr-0">
                <div class="form-group">
                    <div class="col-sm-12">
                        <h4 class="text-center font-weight-bold font-italic mt-3">Manage Header Footer Form</h4>
                    </div>
                </div>
                <form method="POST" action="{{ route('header-and-footer-update') }}" enctype="multipart/form-data" autocomplete="" class="form-inline">
                    @csrf
                   
                    <div class="form-group col-12 mb-3">
                        <label for="title" class="col-sm-3 col-form-label text-right">Owner Name</label>
                        <input id="title" type="text" class="col-sm-9 form-control @error('owner_name') is-invalid @enderror" name="owner_name" value="{{ $headerFooter->owner_name }}" placeholder="Owner Name" required autofocus>
                        @error('owner_name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                         @enderror
                    </div>
    
                    <div class="form-group col-12 mb-3">
                        <label for="department" class="col-sm-3 col-form-label text-right">Owner Department</label>
                        <input id="department" type="text" class="col-sm-9 form-control @error('department') is-invalid @enderror" name="department" value="" placeholder="Owner Department" required value="{{ $headerFooter->department }}">
                        @error('department')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
    
                    <div class="form-group col-12 mb-3">
                        <label for="email" class="col-sm-3 col-form-label text-right">Address</label>
                        <input id="address" type="text" class="col-sm-9 form-control @error('address') is-invalid @enderror" name="address" value="{{ $headerFooter->address }}" placeholder=" Address" required autofocus>
                        @error('address')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                         @enderror
                    </div>
    
                    <div class="form-group col-12 mb-3">
                        <label for="mobile" class="col-sm-3 col-form-label text-right">Mobile</label>
                        <input id="mobile" type="text" class="col-sm-9 form-control @error('mobile') is-invalid @enderror" name="mobile" placeholder="880xxxxxxxx" required value="{{ $headerFooter->mobile}}">
                        @error('mobile')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                         @enderror
                    </div>

                    <div class="form-group col-12 mb-3">
                        <label for="copyright" class="col-sm-3 col-form-label text-right">Copyright</label>
                        <input id="copyright" type="text" class="col-sm-9 form-control @error('copyright') is-invalid @enderror" name="copyright" placeholder="Copyright" required value="{{ $headerFooter->copyright }}">
                        @error('copyright')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                         @enderror
                    </div>
    
                   
    
                    <div class="form-group col-12 mb-3">
                        <label class="col-sm-3"></label>
                        <button type="submit" class="col-sm-9 btn btn-block my-btn-submit">Submit</button>
                    </div>
                    
                <input type="hidden" name="id" value="{{ $headerFooter->id}}">
                </form>
            </div>
        </div>
    </section>
    <!--Content End-->
@endsection