@extends('layouts.frontend.app')

@section('content')
    <!--================ Hero sm Banner start =================-->
    <section class="mb-30px">
        <div class="container">
            <div class="hero-banner hero-banner--sm">
                <div class="hero-banner__content">
                    <h1>Blog Details</h1>
                    <nav aria-label="breadcrumb" class="banner-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{$posts->category->name}}</li>
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
                    <div class="main_blog_details">

                        <img class="img-fluid" src="{{asset('frontend/img/blog/blog4.png')}}" alt="">
                        <a href="#"><h4>{{$posts->title}}</h4></a>
                        <div class="user_details">
                            <div class="float-left">
                                <a href="#">Lifestyle</a>
                                <a href="#">Gadget</a>
                            </div>
                            <div class="float-right mt-sm-0 mt-3">
                                <div class="media">
                                    <div class="media-body">
                                        <h5>{{$posts->user->name}}</h5>
                                        <p>{{$posts->created_at}}</p>
                                    </div>
                                    <div class="d-flex">
                                        <img width="42" height="42" src="{{asset('frontend/img/blog/user-img.png')}}"
                                             alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p>{{$posts->long_description}}</p>

                    </div>


                    <div class="navigation-area">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">

                                @if(isset($previous))
                                    <div class="thumb">
                                        <a href="{{route('post.show',$previous->id) }}"><img class="img-fluid" src="{{asset('frontend/img/blog/prev.jpg')}}" alt=""></a>
                                    </div>
                                    <div class="arrow">
                                        <a href="{{route('post.show',$previous->id) }}"><span
                                                class="lnr text-white lnr-arrow-left"></span></a>
                                    </div>

                                    <div class="detials">
                                        <p>Prev Post</p>
                                        <a href="#"><h4>{{$previous->title}}</h4></a>
                                    </div>
                                @else
                                    <div class="thumb">
                                        <a href="#"><img class="img-fluid" src="{{asset('frontend/img/blog/prev.jpg')}}"
                                                         alt=""></a>
                                    </div>
                                    <div class="arrow">
                                        <a href="#"><span class="lnr text-white lnr-arrow-left"></span></a>
                                    </div>

                                    <div class="detials">

                                        <p>Prev Post</p>
                                        <a href="#"><h4>No more records found</h4></a>

                                    </div>
                                @endif
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                                        @if(isset($next))
                                            <div class="detials">

                                                <p>Next Post</p>
                                                <a href="#"><h4>{{$next->title}}</h4></a>

                                            </div>
                                            <div class="arrow">
                                                <a href="{{route('post.show',$next->id) }}"><span
                                                        class="lnr text-white lnr-arrow-right"></span></a>
                                            </div>
                                            <div class="thumb">
                                                <a href="{{route('post.show',$next->id) }}"><img class="img-fluid"
                                                                                                 src="{{asset('frontend/img/blog/next.jpg')}}"
                                                                                                 alt=""></a>
                                            </div>
                                        @else
                                    <div class="detials">

                                        <p>Next Post</p>
                                        <a href="#"><h4>No More Post Found</h4></a>

                                    </div>
                                    <div class="arrow">
                                        <a href="#"><span
                                                class="lnr text-white lnr-arrow-right"></span></a>
                                    </div>
                                    <div class="thumb">
                                        <a href="#"><img class="img-fluid"
                                                                                         src="{{asset('frontend/img/blog/next.jpg')}}"
                                                                                         alt=""></a>
                                    </div>


                                @endif
                            </div>

                            </div>
                        </div>
                    {{--   <div class="comments-area">
                           <h4>05 Comments</h4>
                           <div class="comment-list">
                               <div class="single-comment justify-content-between d-flex">
                                   <div class="user justify-content-between d-flex">
                                       <div class="thumb">
                                           <img src="img/blog/c1.jpg" alt="">
                                       </div>
                                       <div class="desc">
                                           <h5><a href="#">Emilly Blunt</a></h5>
                                           <p class="date">December 4, 2017 at 3:12 pm </p>
                                           <p class="comment">
                                               Never say goodbye till the end comes!
                                           </p>
                                       </div>
                                   </div>
                                   <div class="reply-btn">
                                       <a href="" class="btn-reply text-uppercase">reply</a>
                                   </div>
                               </div>
                           </div>
                           <div class="comment-list left-padding">
                               <div class="single-comment justify-content-between d-flex">
                                   <div class="user justify-content-between d-flex">
                                       <div class="thumb">
                                           <img src="img/blog/c2.jpg" alt="">
                                       </div>
                                       <div class="desc">
                                           <h5><a href="#">Elsie Cunningham</a></h5>
                                           <p class="date">December 4, 2017 at 3:12 pm </p>
                                           <p class="comment">
                                               Never say goodbye till the end comes!
                                           </p>
                                       </div>
                                   </div>
                                   <div class="reply-btn">
                                       <a href="" class="btn-reply text-uppercase">reply</a>
                                   </div>
                               </div>
                           </div>
                           <div class="comment-list left-padding">
                               <div class="single-comment justify-content-between d-flex">
                                   <div class="user justify-content-between d-flex">
                                       <div class="thumb">
                                           <img src="img/blog/c3.jpg" alt="">
                                       </div>
                                       <div class="desc">
                                           <h5><a href="#">Annie Stephens</a></h5>
                                           <p class="date">December 4, 2017 at 3:12 pm </p>
                                           <p class="comment">
                                               Never say goodbye till the end comes!
                                           </p>
                                       </div>
                                   </div>
                                   <div class="reply-btn">
                                       <a href="" class="btn-reply text-uppercase">reply</a>
                                   </div>
                               </div>
                           </div>
                           <div class="comment-list">
                               <div class="single-comment justify-content-between d-flex">
                                   <div class="user justify-content-between d-flex">
                                       <div class="thumb">
                                           <img src="img/blog/c4.jpg" alt="">
                                       </div>
                                       <div class="desc">
                                           <h5><a href="#">Maria Luna</a></h5>
                                           <p class="date">December 4, 2017 at 3:12 pm </p>
                                           <p class="comment">
                                               Never say goodbye till the end comes!
                                           </p>
                                       </div>
                                   </div>
                                   <div class="reply-btn">
                                       <a href="" class="btn-reply text-uppercase">reply</a>
                                   </div>
                               </div>
                           </div>
                           <div class="comment-list">
                               <div class="single-comment justify-content-between d-flex">
                                   <div class="user justify-content-between d-flex">
                                       <div class="thumb">
                                           <img src="img/blog/c5.jpg" alt="">
                                       </div>
                                       <div class="desc">
                                           <h5><a href="#">Ina Hayes</a></h5>
                                           <p class="date">December 4, 2017 at 3:12 pm </p>
                                           <p class="comment">
                                               Never say goodbye till the end comes!
                                           </p>
                                       </div>
                                   </div>
                                   <div class="reply-btn">
                                       <a href="" class="btn-reply text-uppercase">reply</a>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="comment-form">
                           <h4>Leave a Reply</h4>
                           <form>
                               <div class="form-group form-inline">
                                   <div class="form-group col-lg-6 col-md-6 name">
                                       <input type="text" class="form-control" id="name" placeholder="Enter Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Name'">
                                   </div>
                                   <div class="form-group col-lg-6 col-md-6 email">
                                       <input type="email" class="form-control" id="email" placeholder="Enter email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'">
                                   </div>
                               </div>
                               <div class="form-group">
                                   <input type="text" class="form-control" id="subject" placeholder="Subject" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Subject'">
                               </div>
                               <div class="form-group">
                                   <textarea class="form-control mb-10" rows="5" name="message" placeholder="Messege" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Messege'" required=""></textarea>
                               </div>
                               <a href="#" class="button submit_btn">Post Comment</a>
                           </form>
                       </div>--}}
                    </div>

                    <!-- Start Blog Post Siddebar -->
                    @include('layouts.frontend.partials.sidebar')
                </div>
                <!-- End Blog Post Siddebar -->
            </div>
    </section>
    <!--================ End Blog Post Area =================-->

@endsection

