@extends('layouts.backend.app')
@push('header')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endpush
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
                        Edit Post Data
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
                        <form method="post" action="{{ route('post.update', $posts->id ) }}"
                              enctype="multipart/form-data">
                            <div class="form-group">
                                @csrf
                                @method('PATCH')

                                <div class="form-group">
                                    <label for="title">Title:</label>
                                    <input type="text" class="form-control" name="title" value="{{$posts->title}}"
                                           readonly/>
                                </div>

                                <div class="form-group">
                                    <label for="slug">Slug:</label>
                                    <input type="text" class="form-control" name="slug" value="{{$posts->slug}}"
                                           readonly/>
                                </div>
                                <div class="form-group">
                                    <label for="tags">Tags:</label>
                                    <input type="text" class="form-control" name="tags"
                                           value="@foreach($posts->tags as $key=>$tag)
                                           {{$key+1 < count($posts->tags) ? $tag->name.',' : $tag->name}}@endforeach"/>
                                </div>
                                <div class="form-group">
                                    <label for="cases">Image:</label>
                                    <input type="file" class="form-control" name="image" value=""/>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description:</label>
                                    <textarea rows="3" columns="3" id="summernote" class="form-control"
                                              name="description">{{ $posts->description }}</textarea>
                                </div>

                                <div class="form-group">

                                    <input type="hidden" class="form-control" name="view_count"
                                           value="{{ $posts->view_count }}"/>
                                </div>

                                <div class="form-group">
                                    <label for="status">Status:</label>
                                    <input type="text" class="form-control" name="status" value="public"
                                           value="{{ $posts->status }}" readonly/>
                                </div>
                                <button type="submit" class="btn btn-primary">Update Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
