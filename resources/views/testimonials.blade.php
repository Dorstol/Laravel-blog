@extends('layout')

@section('testimonials')
<div class="carousel-inner" role="listbox">
    @foreach ($test as $item)
                            <div class="item active">
                                <div class="single-review">
                                    <div class="review-text">
                                        <p>{{$item->feedback}}</p>
                                    </div>
                                    <div class="author-id">
                                        <img src="/images/author.png" alt="">

                                        <div class="author-text">
                                            <h4>{{$item->username}}</h4>

                                            <h4>{{$item->about_user}}</h4>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
@endsection