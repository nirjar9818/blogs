@extends('layouts.frontend.app')
@push('header')
@endpush
<!-- .content -->
@section('content')
    <!--================ Hero sm Banner start =================-->
    <section class="mb-30px">
        <div class="container">
            <div class="hero-banner hero-banner--sm">
                <div class="hero-banner__content">
                    <h1>Category Page</h1>
                    <nav aria-label="breadcrumb" class="banner-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Category Page</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!--================ Hero sm Banner end =================-->

    <!--================ Start Blog Post Area =================-->
    <section class="blog-post-area section-margin">
        <div class="container">
            <div class="row">

                <div class="col-md-8">

                    <div class="row">
                        <div class="col-lg-6">
                            @foreach($categories as $category)
                                <div class="single-recent-blog-post card-view">

                                    <div class="thumb">
                                        <img class="card-img rounded-0"
                                             src="{{asset('frontend/img/blog/thumb/thumb-card8.png')}}" alt="">
                                        <ul class="thumb-info">
                                            <li><a href="#"><i class="ti-user"></i>Admin</a></li>
                                            <li><a href="#"><i class="ti-timer"></i>{{$category->created_at->format('Y-M-d')}}</a></li>
                                        </ul>
                                    </div>
                                    <div class="details mt-20">

                                        <a href="blog-single.html">
                                            <h3>{{$category->name}}</h3>
                                        </a>
                                        <p>{{$category->short_description}}</p>
                                        <a class="button" href="#">See Post Belongs To {{$category->name}}<i class="ti-arrow-right"></i></a>
                                    </div>
                                    <br>

                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <nav class="blog-pagination justify-content-center d-flex">
                                <ul class="pagination">

                                    {{$categories->links()}}

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
