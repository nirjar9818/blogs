<!-- Start Blog Post Siddebar -->
<div class="col-lg-4 sidebar-widgets">
    <div class="widget-wrap">
        <div class="single-sidebar-widget newsletter-widget">
            <h4 class="single-sidebar-widget__title">Newsletter</h4>
            <div class="form-group mt-30">
                <div class="col-autos">
                    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Enter email" onfocus="this.placeholder = ''"
                           onblur="this.placeholder = 'Enter email'">
                </div>
            </div>
            <button class="bbtns d-block mt-20 w-100">Subcribe</button>
        </div>


        <div class="single-sidebar-widget post-category-widget">
            <h4 class="single-sidebar-widget__title">Post According to Category</h4>
            @foreach($postAccordingCategory as $post)
            <ul class="cat-list mt-20">
                <li>
                    <a href="{{route('category.show',$post->category_id)}}" class="d-flex justify-content-between">
                        <p>{{$post->category->name}}</p>
                        <p>({{$post->total}})</p>
                    </a>
                </li>

            </ul>
            @endforeach
        </div>

        <div class="single-sidebar-widget popular-post-widget">
            <h4 class="single-sidebar-widget__title">Latest Post</h4>
            <div class="popular-post-list">
                @foreach($latest_posts as $latest_post)
                <div class="single-post-list">
                    <div class="thumb">
                        <img class="card-img rounded-0" src="{{asset('storage/post/'.$latest_post->image)}}" alt="">
                        <ul class="thumb-info">
                            <li><a href="#">{{$latest_post->user->name}}</a></li>
                            <li><a href="#">{{$latest_post->created_at->format('Y-M-d')}}</a></li>
                        </ul>
                    </div>
                    <div class="details mt-20">
                        <a href="{{route('post.show',$latest_post->id)}}">
                            <h6>{{$latest_post->title}}</h6>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="single-sidebar-widget tag_cloud_widget">
            <h4 class="single-sidebar-widget__title">All Tags</h4>
            <ul class="list">
                <li>

                        @foreach($tags as $tag)
                            <a href="{{route('post.tag',$tag->name)}}" class="btn btn-outline-info btn-sm">{{$tag->name}}</a>
                        @endforeach

                </li>

            </ul>
        </div>
    </div>
</div>

<!-- End Blog Post Siddebar -->
