@extends('layout')

@section('content')
<!--main content start-->
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                <div class="leave-comment mr0"><!--leave comment-->
                    
                    <h3 class="text-uppercase" style="text-align:center;">How you can contact me ?</h3>
                    <br>
                    <img src="assets/images/abc.jpg" alt="" class="profile-image">
                </div><!--end leave comment-->
            </div>
            @include('pages._sidebar')
        </div>
    </div>
</div>
<!-- end main content-->


@endsection