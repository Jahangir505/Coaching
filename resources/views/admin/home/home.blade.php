
@extends('admin.master')

@section('content')

@if(Session::get('msg'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Message:</strong> {{ Session::get('msg') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
</div>
@endif

     <!--Slider Start-->
     <section class="container-fluid">
        <div class="row">
            <div class="col-12 pl-0 pr-0">
                <div class="owl-carousel">
                 @foreach($slider as $slide)
                    <div class="item">
                        <img src="{{asset('/')}}{{ $slide->slide_image}}" alt="">
                        <div class="carousel-caption">
                            <h2>{{ $slide->slide_title}}</h2>
                            <p>{{ $slide->slide_description}}</p>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </section>
    <!--Slider End-->

@endsection
    
   

