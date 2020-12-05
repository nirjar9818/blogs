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
                                    <li class="list-inline-item"><a href="{{route('category.index')}}">Category</a></li>
                                    <li class="list-inline-item seprate">
                                        <span>/</span>
                                    </li>
                                    <li class="list-inline-item"><a href="{{route('category.show',$categories->id)}}">View</a>
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
                        View Category Data
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
                        <form method="post" action="{{ route('category.show', $categories->id ) }}" >
                            <div class="row">
                                <div class="col-sm-8 colxs-4">
                                    <div class="form-group">
                                        @csrf
                                        @method('PATCH')
                                        <label for="name">Name:</label>
                                        <input type="text" class="form-control" name="name"
                                               value="{{ $categories->name }}" readonly/>
                                    </div>

                                    <div class="form-group">
                                        <label for="slug">Slug:</label>
                                        <input type="text" class="form-control" name="slug"
                                               value="{{ $categories->slug }}" readonly/>
                                    </div>

                                    <div class="form-group">
                                        <label for="created_at">Created At:</label>
                                        <input type="text" class="form-control" name="created_at"
                                               value="{{ $categories->created_at->format('Y-M-d') }}" readonly/>
                                    </div>
                                    <div class="form-group">
                                        <label for="updated_at">Updated At:</label>
                                        <input type="text" class="form-control" name="updated_at"
                                               value="{{ $categories->updated_at->format('Y-M-d') }}" readonly/>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-4">
                                    <div class="form-group">
                                        <label for="image">Image:</label>
                                        <img src="{{asset('storage/category/'.$categories->image)}}"
                                             class="img-thumbnail" alt="{{$categories->image}}" name="image"
                                             width="300px">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea rows="20" columns="10" class="form-control" name="description"
                                          readonly>{{ $categories->description }}
                                </textarea>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
