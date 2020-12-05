@extends('layouts.frontend.app')
@push('header')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endpush
@section('content')
    <!--================ Hero sm Banner start =================-->
    <section class="mb-30px">
        <div class="container">
            <div class="hero-banner hero-banner--sm">
                <div class="hero-banner__content">
                    <h1>Blog Page</h1>
                    <nav aria-label="breadcrumb" class="banner-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Blog</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Blog</li>
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
                        <div class="col-md-12">
                            <div class="card uper">
                                <div class="card-header">
                                    <h4>Edit Blog<h4>
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
                                    <form method="post" action="{{ route('post.update' ,$posts->id) }}">
                                        @csrf
                                        <div class="form-group">

                                            <input type="hidden" class="form-control" name="user_id"
                                                   value="{{Auth::user()->id}}" readonly/>
                                        </div>
                                        <div class="form-group">
                                            <label for="user_name">User Name:</label>
                                            <input type="text" class="form-control" name="user_name"
                                                   value="{{Auth::user()->name}}" readonly/>
                                        </div>
                                        <div class="form-group">
                                            <label for="category_id">Category:</label>
                                            <select class="form-control" name="category_id">

                                                <option value="{{$posts->category->id}}"> {{$posts->category->name}}>
                                                </option>
                                                @foreach ($posts as $post)
                                                    <option
                                                        value="{{$posts->category->id}}"> {{$posts->category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="title">Title:</label>
                                            <input type="text" class="form-control" name="title"
                                                   value="{{$posts->title}}"/>
                                        </div>

                                        <div class="form-group">
                                            <label for="slug">Slug:</label>
                                            <input type="text" class="form-control" name="slug"
                                                   value="{{$posts->slug}}"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="cases">Image:</label>
                                            <input type="file" class="form-control" name="image" value=""/>
                                        </div>
                                        <div class="form-group">
                                            <label for="short_description">Short Description:</label>
                                            <textarea rows="3" columns="3" id="summernote" class="form-control"
                                                      name="short_description" {{$posts->short_description}}></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="long_description">Long Description:</label>
                                            <textarea rows="9" columns="9" id="summernote2" class="form-control"
                                                      name="long_description" {{$posts->long_description}}></textarea>
                                        </div>
                                        <div class="form-group">

                                            <input type="hidden" class="form-control" name="view_count" value='0'/>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status:</label>
                                            <input type="text" class="form-control" name="status" value="public"/>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Add Data</button>
                                    </form>
                                </div>
                            </div>
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


@push('footer')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#summernote').summernote({
                tabsize: 2,
                height: 200
            });
            $('#summernote2').summernote({
                tabsize: 2,
                height: 500
            });
        });
    </script>
@endpush
