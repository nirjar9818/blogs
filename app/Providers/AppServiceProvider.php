<?php

namespace App\Providers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //return all rows of post according to category
        $postAccordingCategory = Post::groupBy('category_id')->select('category_id',DB::raw('count(category_id) as total'))->get();

        //return latest_post
        $latest_posts = Post::select('*')->orderBy('created_at', 'desc')->limit(3)->get();

        $tags=Tag::groupBy('name')->select('name',DB::raw('name'))->get();

        View::share('postAccordingCategory',$postAccordingCategory);
        View::share('latest_posts',$latest_posts);
        View::share('tags',$tags);
    }
}
