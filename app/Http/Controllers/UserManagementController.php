<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role == 1) {
            $users = User::Paginate(10);

            return view('admin.user.index', compact('users'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::findOrFail($id);

        return view('admin.user.edit', compact('users'));
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
                'name' => 'required|max:255',
                'role' => 'required',
                'bio' => 'required|min:30',
                'email' => 'required|email',
                'image' => 'sometimes|image|mimes:jpg,png,bmp,jpeg',
            ]);


        $users = User::findOrFail($id);
        if ($request->image != null) {
            //image
            $image = $request->image;
            $imageName = str::slug($request->name, '-') . uniqid() . '.' . $image->getClientOriginalExtension();


            if (!storage::disk('public')->exists('user')) {
                Storage::disk('public')->makeDirectory('user');
            }
            //delete old image
            if (!storage::disk('public')->exists('user/' . $users->image)) {
                Storage::disk('public')->delete('user/' . $users->image);
            }
            //store
            $image->storeAs('user', $imageName, 'public');

        } else {
            $imageName = $users->image;
        }

        $users->name = $request->name;
        $users->slug = Str::slug($request->name, '-');
        $users->email = $request->email;
        $users->role = $request->role;
        $users->bio = $request->bio;
        $users->image = $imageName;

        $users->save();

        return redirect(route('user.index'))->with('success', 'User Data is successfully updated');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users = User::findOrFail($id);
        //delete image if exist
        if (Storage::disk('public')->exists('user/' . $users->image)) {
            Storage::disk('public')->delete('user/' . $users->image);
        }
        $users->delete();

        return redirect(route('user.index'))->with('success', 'User Data is successfully deleted');
    }

    public function profile()
    {
        if (auth()->user()->role == 1) {
            //return user according to user_id
            $users = User::find(auth::user()->id);
            return view('admin.profile', compact('users'));
        } else {

            //return user according to user_id
            $users = User::find(auth::user()->id);
            return view('user.profile', compact('users'));
        }
    }

    public function updateProfile(Request $request)
    {
        // Fix the update issue
        if ($request->name == User::findOrFail(Auth::id())->name) {
            $this->validate($request, [
                'name' => 'required|max:255',
                'role' => 'required',
                'bio' => 'required|min:30',
                'email' => 'required|email',
                'image' => 'sometimes|image|mimes:jpg,png,bmp,jpeg',

            ]);
        } else {
            $this->validate($request, [
                'name' => 'required|max:255',
                'role' => 'required',
                'bio' => 'required|min:30',
                'email' => 'required|email',
                'image' => 'sometimes|image|mimes:jpg,png,bmp,jpeg',

            ]);
        }
        $user = User::findOrFail(Auth::user()->id);
        if ($request->image != null) {
            // Image
            $image = $request->image;
            $imageName = Str::slug($request->name, '-') . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('user')) {
                Storage::disk('public')->makeDirectory('user');
            }
            // Delete old Image
            if ($user->image !== 'default.jpg' && Storage::disk('public')->exists('user/' . $user->image)) {
                Storage::disk('public')->delete('user/' . $user->image);
            }
            // Store
            // $image->storeAs('user', $imageName, 'public');
            $userImg = Image::make($image)->fit(200, 200)->stream();
            Storage::disk('public')->put('user/' . $imageName, $userImg); //The put method may be used to store raw file contents on a disk
        } else {
            $imageName = $user->image;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->image = $imageName;
        $user->bio = $request->bio;
        $user->role = $request->role;
        $user->save();
        return redirect()->back()->with('success', 'Profile Data is successfully Updated');
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|max:255|confirmed'
        ]);

        // Cross check the old password
        $oldPass = Auth::user()->password; // hashed
        if (Hash::check($request->old_password, $oldPass)) {
            // old pass shoud not be same as new pass
            if (!Hash::check($request->password, $oldPass)) {
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();

                // Logout
               // Auth::logout();
                return redirect(route('profile.password'))->with('success','Password has been changed successfully');

            } else {

                return redirect(route('profile.password'))->with('error','New password should not be same as old password');
            }
        } else {

            return redirect(route('profile.password'))->with('error','Enter the correct old password');

        }
    }

}
