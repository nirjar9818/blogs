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


    <section class="user">
        <div class="section__content section__content--p30 p-t-30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-user"></i>
                                <strong class="card-title pl-2">Profile</strong>
                            </div>
                            <div class="card-body">
                                <div class="mx-auto d-block">
                                    <img class="rounded-circle mx-auto d-block"
                                         src="{{asset('storage/user/'.Auth::user()->image)}}" alt="Card image cap">
                                    <h5 class="text-sm-center mt-2 mb-1">{{Auth::user()->name}}</h5>
                                    <div class="location text-sm-center">
                                        <i class="fa fa-map-marker"></i>{{Auth::user()->email}}</div>
                                </div>
                                <hr>
                                <div class="card-text text-sm-center">
                                    <a href="#">
                                        <i class="fa fa-facebook-official" aria-hidden="true"></i>

                                    </a>
                                    <a href="#">
                                        <i class="fa fa-map-marker"></i>
                                    </a>
                                    <a href="#">
                                        <i class="fa fa-linkedin pr-1"></i>
                                    </a>
                                    <a href="#">
                                        <i class="fa fa-pinterest pr-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <div class="card">
                            <div class="card-header">
                                <h4>Edit Details</h4>
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

                                <div class="default-tab">
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab"
                                               href="#nav-profile" role="tab" aria-controls="nav-profile"
                                               aria-selected="false">Profile</a>
                                            <a class="nav-item nav-link" id="nav-settings-tab" data-toggle="tab"
                                               href="#nav-settings" role="tab" aria-controls="nav-settings"
                                               aria-selected="false">Settings</a>
                                        </div>
                                    </nav>
                                    <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-profile" role="tabpanel"
                                             aria-labelledby="nav-profile-tab">
                                            <form method="post" action="{{ route('profile.update') }}"
                                                  enctype="multipart/form-data">
                                                <div class="form-group">
                                                    @csrf
                                                    @method('PUT')
                                                    <label for="name">Name:</label>
                                                    <input type="text" class="form-control" name="name"
                                                           value="{{ $users->name }}" readonly/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email:</label>
                                                    <input type="email" class="form-control" name="email"
                                                           value="{{ $users->email }}" readonly/>
                                                </div>

                                                <div class="form-group">
                                                    <label for="cases">Roles:</label>
                                                    <input type="text" class="form-control" name="role"
                                                           value="{{ $users->role }}" readonly/>
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
                                        <div class="tab-pane fade" id="nav-settings" role="tabpanel"
                                             aria-labelledby="nav-settings-tab">
                                            <div class="col-lg-12">
                                                <form action="{{route('profile.password')}}" method="POST"
                                                      enctype="multipart/form-data" class="form-horizontal">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row form-group">
                                                        <div class="col col-md-3"><label for="old_password"
                                                                                         class=" form-control-label">Old
                                                                Password</label></div>
                                                        <div class="col-12 col-md-9"><input type="password"
                                                                                            id="old_password"
                                                                                            name="old_password"
                                                                                            placeholder="Password"
                                                                                            class="form-control"></div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col col-md-3"><label for="password"
                                                                                         class=" form-control-label">New
                                                                Password</label></div>
                                                        <div class="col-12 col-md-9"><input type="password" id="password"
                                                                                            name="password"
                                                                                            placeholder="Password"
                                                                                            class="form-control"></div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col col-md-3"><label for="password_confirmation"
                                                                                         class=" form-control-label">Confirm
                                                                Password</label></div>
                                                        <div class="col-12 col-md-9"><input type="password"
                                                                                            id="password_confirmation"
                                                                                            name="password_confirmation"
                                                                                            placeholder="Password"
                                                                                            class="form-control"></div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary btn-sm">
                                                        <i class="fa fa-dot-circle-o"></i> Submit
                                                    </button>
                                                </form>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /# column -->

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
