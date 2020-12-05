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
                        Edit User Data
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
                        <form method="post" action="{{ route('user.update', $users->id ) }}" enctype="multipart/form-data">
                            <div class="form-group">
                                @csrf
                                @method('PATCH')
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" name="name" value="{{ $users->name }}" readonly/>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" name="email" value="{{ $users->email }}" readonly/>
                            </div>

                            <div class="form-group">
                                <label for="cases">Roles:</label>
                                <input type="text" class="form-control" name="role" value="{{ $users->role }}" readonly/>
                            </div>
                            <div class="form-group">
                                <label for="bio">Bio:</label>
                                <textarea rows="3" columns="3" id="summernote" class="form-control"
                                          name="bio">{{ $users->bio }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="image">image:</label>
                                <input type="file" class="form-control" name="image" value=""/>

                            </div>
                            <button type="submit" class="btn btn-primary">Update Data</button>
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
        });
    </script>
@endpush
