<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view("admin.users.index")->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validates
         $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'profile_photo' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // requests and checks for valdation
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->uuid = Str::uuid();
        $user->role = $request->route()->getName() == 'admin.register' ? 'admin' : 'regular';

        // check if profile photo exists and save the name of the image to the database
        if ($request->hasFile('profile_photo')) {
        $image = $request->file('profile_photo');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);
        $user->profile_photo = $new_name;
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
 public function edit(User $user)
{
    // only authenticated users can edit their own profile
    if (Auth::id() == $user->id || Auth::id() == 1) {
        return view('admin.users.create')->with('user', $user);
    }

    // no user is allowed to edit the super admin with id of 4
    if ($user->id == 1) {
        return redirect()->back()->with('error', 'You are not authorized to edit the super admin profile.');

    }

    // admins cant edit each other but can edit regular users && users cant edit each other
    if (Auth::user()->role == 'admin' && $user->role == 'admin') {
        return redirect()->back()->with('error', 'You are not authorized to edit this user.');
    } elseif (Auth::user()->role != 'admin' || $user->role != 'regular') {
        return redirect()->back()->with('error', 'You are not authorized to edit this user.');
    }

    return view('admin.users.create')->with('user', $user);
}


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $users = User::whereIn('id', $user)->get();
        foreach ($users as $user) {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->uuid = Str::uuid();

            //checks if password exists
            if ($request->input('password')) {
                $password = $request->input('password');
                $confirm_password = $request->input('confirm_password');
                if ($password === $confirm_password) {
                    $user->password = bcrypt($password);
                } else {
                    return redirect()->back()->with('error', 'Password and confirm password do not match');
                }
            }

            // checks and update if profile image exists
            if ($request->hasFile('profile_photo')) {
                $old_photo = public_path('images/' . $user->profile_photo);
                if (File::exists($old_photo)) {
                    File::delete($old_photo);
                }
                $image = $request->file('profile_photo');
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $new_name);
                $user->profile_photo = $new_name;
            } else {
                $user->profile_photo = $user->profile_photo;
            }
            $user->save();
        }

        return redirect()->route('users.index')->with('success', 'Users updated successfully');
    }

    public function changeRole(User $user, Request $request) {
        if (Auth::user()->role == 'admin' && $user->role == 'admin' && Auth::user()->id != 1) {
            return redirect()->back()->with('error', 'You are not authorized to edit fellow admin\'s role.');
        }

        $user->role = $user->role == 'regular' ? 'admin' : 'regular';
        $user->save();

        return redirect()->back()->with('success', 'User role changed successfully.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(User $user)
    {
        // admins and regular users can edit their profile
        if (Auth::id() == $user->id || Auth::id() == 1) {
            $user->delete();
            return redirect()->route('users.index');
        }

        // no user is allowed to edit the the super user with id === 4
        if ($user->id == 1) {
            return redirect()->back()->with('error', 'You are not authorized to delete the super admin.');
        }

        // admins and fellow users are not allowed to delete each other
        if (Auth::user()->role == 'admin' && $user->role == 'admin') {
            return redirect()->back()->with('error', 'You are not authorized to delete fellow admins.');
        } elseif (!Auth::user()->role == 'admin' || $user->role != 'regular') {
            return redirect()->back()->with('error', 'You are not authorized to delete fellow users.');
        }

        $user->delete();
        return redirect()->route('users.index');
    }
    }
