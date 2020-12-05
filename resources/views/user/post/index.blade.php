@extends('layouts.frontend.app')

@section('content')
    <!--================ Hero sm Banner start =================-->
    <section class="mb-30px">
        <div class="container">
            <div class="hero-banner hero-banner--sm">
                <div class="hero-banner__content">
                    <h1>Post Page</h1>
                    <nav aria-label="breadcrumb" class="banner-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Post Page</li>
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
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-md-6">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div><br/>
                            @elseif(session()->get('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            @endif
                            @foreach($posts as $post)
                                <div class="single-recent-blog-post card-view">
                                    <div class="thumb">
                                        <img class="card-img rounded-0"
                                             src="{{asset('storage/post/'.$post->image)}}" alt="{{$post->image}}">
                                        <ul class="thumb-info">
                                            <li><a href="#"><i class="ti-user"></i>{{$post->user->name}}</a></li>
                                            <li><a href="#"><i
                                                        class="ti-timer"></i>{{$post->created_at->format('Y-M-d')}}</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="details mt-20">
                                        <a href="{{route('post.show',$post->id)}}">
                                            <h3>{{$post->title}}</h3>
                                        </a>
                                        <p>{!! Str::words($post->description,40)!!}</p>
                                        <a class="button" href="{{route('post.show',$post->id)}}">Read More <i
                                                class="ti-arrow-right"></i></a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

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
