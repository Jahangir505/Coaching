@extends('admin.master')

@section('content')

<!--Content Start-->
<section class="container-fluid">
        <div class="row content">
            <div class="col-12 pl-0 pr-0">
                <h2 class="text-center font-weight-bold font-italic mt-3">Our Gallery</h2>
            </div>

            @foreach($slide as $slid)
    
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 pl-0 pr-0">
                    <a class="image-link" href="{{asset('/')}}{{ $slid->slide_image}}"><img class="img-thumbnail" src="{{asset('/')}}{{ $slid->slide_image}}" alt=""></a>
                </div>

            @endforeach
    
        </div>
    </section>
    <!--Content End-->


@endsection