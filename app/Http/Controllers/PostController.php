<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use App\User;
use Faker\Guesser\Name;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (auth()->user()->role == 1) {
//
            $posts = Post::paginate(7);
//
            return view('admin.post.index', compact('posts'));

        } else {

            //return post  rows with pagination
            $posts = Post::paginate(5
            );


            return view('user.post.index', compact('posts'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->role == 1) {
            $users = User::all();
            $categories = Category::all();
            return view('admin.post.create', ['users' => $users, 'categories' => $categories]);
        } else {

            $users = User::all();
            $categories = Category::all();

            return view('user.post.create', compact('users', 'categories'));
        }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([

            'title' => 'required|max:255',
            'description' => 'required',
            'tags' => 'required',
            'view_count' => 'sometimes',
            'status' => 'sometimes',
            'image' => 'sometimes|image|mimes:jpg,png,bmp,jpeg',

        ]);
        //slug
        $slug = str::slug($request->title, '-');
        //image
        $image = $request->image;
        $imageName = $slug . uniqid() . '.' . $image->getClientOriginalExtension();

        if (!storage::disk('public')->exists('post')) {
            Storage::disk('public')->makeDirectory('post');
        }
        //image cropped
        $img = Image::make($image)->resize(752, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->stream();

        // Store in storage public/category
        Storage::disk('public')->put('post/' . $imageName, $img); //The put method may be used to store raw file contents on a disk


        $post = new Post();
        $post->user_id = Auth::id();
        $post->category_id = $request->category_id;
        $post->title = $request->title;
        $post->slug = $slug;
        $post->description = $request->description;
        $post->image = $imageName;
        $post->view_count = '0';
        $post->status = 'public';
        $post->save();

        $tags = [];
        $stringTags = array_map('trim', explode(',', $request->tags));
        foreach ($stringTags as $tag) {
            array_push($tags, ['name' => $tag]);
        }
        $post->tags()->createMany($tags);


        return redirect(route('post.index'))->with('success', 'Post is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        if (auth()->user()->role == 1) {
            $posts = Post::findOrFail($id);
            return view('admin.post.show', compact('posts'));

        } else {

            $posts = Post::findorFail($id);

            // get previous post id
            $previous = Post::where('id', '<', $posts->id)->orderBy('id', 'desc')->first();

            // get next post id
            $next = Post::where('id', '>', $posts->id)->orderBy('id')->first();


        }

        return view('user.post.show', compact('posts', 'previous', 'next'));


    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->role == 1) {
            $posts = Post::findOrFail($id);

            return view('admin.post.edit', compact('posts'));

        } else {
            $posts = Post::findOrFail($id);

            return view('user.post.edit', compact('posts'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([


            'description' => 'required',
            'view_count' => 'sometimes',
            'status' => 'sometimes',
            'image' => 'sometimes|image|mimes:jpg,png,bmp,jpeg',
            'tags' => 'sometimes',
        ]);
        $post = Post::findOrFail($id);
        if ($request->image != null) {
            //image
            $image = $request->image;
            $imageName = str::slug($request->title, '-') . uniqid() . '.' . $image->getClientOriginalExtension();


            if (!storage::disk('public')->exists('post')) {
                Storage::disk('public')->makeDirectory('post');
            }
            //delete old image
            if (!storage::disk('public')->exists('post/' . $post->image)) {
                Storage::disk('public')->delete('post/' . $post->image);
            }
            //store
            $image->storeAs('post', $imageName, 'public');

        } else {
            $imageName = $post->image;
        }


        $post->description = $request->description;
        $post->image = $imageName;
        $post->view_count = '0';
        $post->status = 'public';

        $post->save();

        //delete old tags
        $post->tags()->delete();

        $tags = [];
        $stringTags = array_map('trim', explode(',', $request->tags));

        foreach ($stringTags as $tag) {
            array_push($tags, ['name' => $tag]);
        }
        $post->tags()->createMany($tags);

        return redirect(route('post.index'))->with('success', 'Post Data is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $posts = Post::findOrFail($id);
        //delete image if exist
        if (Storage::disk('public')->exists('post/' . $posts->image)) {
            Storage::disk('public')->delete('post/' . $posts->image);
        }
        //delete tags
        $posts->tags()->delete();
        $posts->delete();

        return redirect(route('post.index'))->with('success', 'Post Data is successfully deleted');
    }

    public function myPost()
    {
        //return Users
        $users = User::all();

        //return categories
        $categories = Category::all();

        //return post according to user_id
        $posts = Post::where('user_id', '=', auth()->user()->id)->get();

        return view('user.post.myPost', compact('posts', 'categories', 'users'));
    }

    public function tag($name)
    {
        $tags = Tag::where('name', 'LIKE', $name)->pluck('post_id');
    //$tags=Tag::all();
     printf($tags);

     foreach ($tags as $tag){
        $posts = Post::where('id','=',$tag)->paginate(3);
        
            
     }

      printf($posts);
  
       
        return view('user.tag.show', compact('posts'));
    }

}
