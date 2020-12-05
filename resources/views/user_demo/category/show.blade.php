@extends('layouts.frontend.app')

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
                                    <li class="list-inline-item"> <a href="#">Dashboard</a></li>
                                    <li class="list-inline-item seprate">
                                        <span>/</span>
                                    </li>
                                    <li class="list-inline-item"> <a href="{{route('category.index')}}">Category</a></li>
                                    <li class="list-inline-item seprate">
                                        <span>/</span>
                                    </li>
                                    <li class="list-inline-item"> <a href="{{route('category.show',$categories->show)}}">View</a></li>

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
                            </div><br />
                        @endif
                            <form method="post" action="{{ route('category.show', $categories->id ) }}">
                                <div class="form-group">
                                    @csrf
                                    @method('PATCH')
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control" name="name" value="{{ $categories->name }}" readonly/>
                                </div>
                                <div class="form-group">
                                    <label for="slug">Slug:</label>
                                    <input type="text" class="form-control" name="slug" value="{{ $categories->slug }}"  readonly/>
                                </div>
                                <div class="form-group">
                                    <label for="short_description">Short Description:</label>
                                    <textarea rows="3" columns="3" class="form-control" name="short_description"  readonly>{{ $categories->short_description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="long_description">Long Description:</label>
                                    <textarea rows="9" columns="9" class="form-control" name="long_description"  readonly>{{ $categories->long_description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="cases">Image:</label>
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
