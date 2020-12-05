<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (auth()->user()->role == 1) {
            $categories = Category::Paginate(10);

            return view('admin.category.index', compact('categories'));
        } else {
            //return all rows of category with pagination 2
            $categories = Category::Paginate(5);

            return view('user.category.index', compact('categories'));
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:categories',
            'description' => 'required',
            'image' => 'sometimes|image|mimes:jpg,png,bmp,jpeg',

        ]);
        //image
        $image = $request->image;
        $imageName = $request->name . uniqid() . '.' . $image->getClientOriginalExtension();

        if (!storage::disk('public')->exists('category')) {
            Storage::disk('public')->makeDirectory('category');
        }
        //store
        $image->storeAs('category', $imageName, 'public');
        //  $show = Category::create($validatedData);


//        // Store in storage public/category
//        Storage::disk('public')->put('category/' . $imageName, $image); //The put method may be used to store raw file contents on a disk


        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name, '-');
        $category->description = $request->description;
        $category->image = $imageName;
        $category->save();

        return redirect(route('category.index'))->with('success', 'Category is successfully saved');
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
            $categories = Category::findOrFail($id);
            return view('admin.category.show', compact('categories'));

        } else {

            $categories = Category::findOrFail($id);
            $posts = Post::select('*')
                ->where('category_id', '=', $id)->paginate(4);
            return view('user.category.show', compact('categories','posts'));


        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::findOrFail($id);

        return view('admin.category.edit', compact('categories'));
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
        if ($request->name==Category::findOrFail($id)->name){
            $request->validate([
                'name' => 'required|max:255',
                'slug' => 'required',
                'description' => 'required',
                'image' => 'sometimes|image|mimes:jpg,png,bmp,jpeg',
            ]);
        }else{
            $request->validate([
                'name' => 'required|max:255|unique:categories',
                'slug' => 'required',
                'description' => 'required',
                'image' => 'sometimes|image|mimes:jpg,png,bmp,jpeg',
            ]);
        }

        $category = Category::findOrFail($id);
        if ($request->image != null) {
            //image
            $image = $request->image;
            $imageName = $request->name . uniqid() . '.' . $image->getClientOriginalExtension();


            if (!storage::disk('public')->exists('category')) {
                Storage::disk('public')->makeDirectory('category');
            }
            //delete old image
            if (!storage::disk('public')->exists('category/' . $category->image)) {
                Storage::disk('public')->delete('category/' . $category->image);
            }
            //store
            $image->storeAs('category', $imageName, 'public');

        }else{
            $imageName=$category->image;
        }

        $category->name = $request->name;
        $category->slug = Str::slug($request->name, '-');
        $category->description = $request->description;
        $category->image = $imageName;

        $category->save();

        return redirect(route('category.index'))->with('success', 'Category Data is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categories = Category::findOrFail($id);
        //delete image if exist
        if (Storage::disk('public')->exists('category/'.$categories->image)){
            Storage::disk('public')->delete('category/'.$categories->image);
        }
        $categories->delete();

        return redirect(route('post.index'))->with('success', 'Post Data is successfully deleted');
    }
}
