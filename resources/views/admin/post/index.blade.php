@extends('layouts.backend.app')

<!-- .content -->
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
                                    <li class="list-inline-item active">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="list-inline-item seprate">
                                        <span>/</span>
                                    </li>
                                    <li class="list-inline-item">Dashboard</li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END BREADCRUMB-->


    <section class="user">
        <div class="section__content section__content--p30 p-t-30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">

                        <div class="card-header">
                            All Post List
                            <a href="{{route('post.create')}}" class="btn btn-success">Add Post</a>
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
                            @elseif(session()->get('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            @endif
                            <table class="table table-striped table-bordered" id="post_table">
                                <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>User Name</td>
                                    <td>Category Name</td>
                                    <td>Title</td>
                                    <td>Slug</td>

                                    <td>Created At</td>
                                    <td>Updated At</td>

                                    <td>Show</td>
                                    <td>Edit</td>
                                    <td>Delete</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $post)
                                    <tr>
                                        <td>{{$post->id}}</td>
                                        <td>{{$post->user->name}}</td>
                                        <td>{{$post->category->name}}</td>
                                        <td>{{$post->title}}</td>
                                        <td>{{$post->slug}}</td>
                                        <td>{{$post->created_at->format('Y-M-d')}}</td>
                                        <td>{{$post->updated_at->format('Y-M-d')}}</td>


                                        <td><a href="{{ route('post.show', $post->id)}}" class="btn btn-info">Show</a>
                                        </td>
                                        <td><a href="{{ route('post.edit', $post->id)}}"
                                               class="btn btn-primary">Edit</a></td>
                                        <td>
                                            <form action="{{ route('post.destroy', $post->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table><br>
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
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

