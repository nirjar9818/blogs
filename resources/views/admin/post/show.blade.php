@extends('layouts.backend.app')

@section('content')


    <!-- BREADCRUMB-->
    <section class="au-breadcrumb m-t-75">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="au-breadcrumb-content">
                            <div class="au-breadcrumb-left ">
                                <span class="au-breadcrumb-span">You are here:</span>
                                <ul class="list-unstyled list-inline au-breadcrumb__list">
                                    <li class="list-inline-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="list-inline-item seprate">
                                        <span>/</span>
                                    </li>
                                    <li class="list-inline-item"><a href="#">Dashboard</a></li>
                                    <li class="list-inline-item seprate">
                                        <span>/</span>
                                    </li>
                                    <li class="list-inline-item"><a href="{{route('post.index')}}">Post</a></li>
                                    <li class="list-inline-item seprate">
                                        <span>/</span>
                                    </li>
                                    <li class="list-inline-item"><a href="{{route('post.show',$posts->id)}}">View</a>
                                    </li>

                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END BREADCRUMB-->
    <!-- CREATE USER-->
    <section class="create_user">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <style>
                    .uper {
                        margin-top: 40px;
                    }
                </style>
                <div class="card uper">
                    <div class="card-header">
                        View Post Data
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div><br/>
                        @endif
                        <form method="post" action="{{ route('post.show', $posts->id ) }}">
                            @csrf
                            <img src="{{asset('storage/post/'.$posts->image)}}" alt="{{$posts->image}}" width="1080px"
                                 height="768px">
                            <div class="form-group">
                                <h1>{{$posts->title}}</h1>
                            </div>
                            <hr>
                            <div class="form-group">
                                Created At: {{$posts->created_at->format('Y-M-d')}} &emsp; &emsp;
                                Created By: {{$posts->user->name}}
                            </div>
                            <div class="form-group">
                                Tags: @if($posts->tags)
                                          @foreach($posts->tags as $tag)
                                              <a href="#" class="btn btn-outline-info btn-sm">{{$tag->name}}</a>
                                    @endforeach
                                @endif
                                Privacy: {{$posts->status}}
                            </div>
                            <hr>
                            <div class="form-group">
                                <h4>Description:</h4>{!!$posts->description!!}
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
