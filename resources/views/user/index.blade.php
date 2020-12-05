@extends('layouts.frontend.app')

@section('content')
<!--================Hero Banner start =================-->
<section class="mb-30px">
    <div class="container">
        <div class="hero-banner">
            <div class="hero-banner__content">
                <h3>Computer & Technology</h3>
                <h1>Amazing Technology</h1>

            </div>
        </div>
    </div>
</section>
<!--================Hero Banner end =================-->

<!--================ Blog slider start =================-->
<section>
    <div class="container">
        <div class="owl-carousel owl-theme blog-slider">
            @foreach($categories as $category)
            <div class="card blog__slide text-center">
                <div class="blog__slide__img">
                    <img class="card-img rounded-0" src="{{asset('storage/category/'.$category->image)}}" alt="{{$category->image}}">
                </div>
                <div class="blog__slide__content">
                    <a class="blog__slide__label" href="#">{{$category->name}}</a>

                    <p>{{$category->created_at->diffForHumans()}}</p>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>
<!--================ Blog slider end =================-->

<!--================ Start Blog Post Area =================-->
<section class="blog-post-area section-margin mt-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="single-recent-blog-post">
                    @foreach($posts as $post)
                    <div class="thumb">
                        <img class="img-fluid" src="{{asset('storage/post/'.$post->image)}}" alt="">
                        <ul class="thumb-info">
                            <li><a href="#"><i class="ti-user"></i>{{$post->user->name}}</a></li>
                            <li><a href="#"><i class="ti-notepad"></i>{{$post->created_at->format('Y-M-d')}}</a>
                            </li>
                            <li><a href="#"><i class="ti-themify-favicon"></i>0 Comments</a></li>
                        </ul>
                    </div>

                    <div class="details mt-20">
                        <a href="{{route('post.show',$post->id)}}">
                            <h3>{{$post->title}}</h3>
                        </a>
                        <p class="tag-list-inline"> Tags:

                        </p>
                        <p>{!! Str::words($post->description,90) !!}</p>
                        <a class="button" href="{{route('post.show',$post->id)}}">Read More <i class="ti-arrow-right"></i></a>
                    </div>
                    <br>
                    @endforeach
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <nav class="blog-pagination justify-content-center d-flex">
                            <ul class="pagination">

                                {{$posts->links()}}

                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Start Blog Post Siddebar -->
            @include('layouts.frontend.partials.sidebar')
        </div>
        <!-- End Blog Post Siddebar -->
    </div>
</section>
<!--================ End Blog Post Area =================-->
@endsection