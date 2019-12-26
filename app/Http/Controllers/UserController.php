<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filterEmail = $request->get('email');
        $filterName = $request->get('name');
        $filterStatus = $request->get('status');
        
        $user = User::orderBy('id', 'asc');
        if ($request->has('email')){
            if (!empty($filterEmail)) {
                $user->where('email', 'like', '%'.$filterEmail.'%');
            }
        }

        if ($request->has('name')){
            if (!empty($filterName)) {
                $user->where('name', 'like', '%'.$filterName.'%');
            }
        }

        if ($request->has('status')){
            if (!empty($filterStatus)) {
                $user->where('status', $filterStatus);
            }
        }

        $users = $user->paginate(10);
        
        return view("users.index", [ 'users' => $users ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("users.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newUser = new User; 

        $newUser->name = $request->get('name');
        $newUser->username = $request->get('username');
        $newUser->roles = json_encode($request->get('roles'));
        $newUser->name = $request->get('name');
        $newUser->address = $request->get('address');
        $newUser->phone = $request->get('phone');
        $newUser->email = $request->get('email');
        $newUser->password = \Hash::make($request->get('password'));
        $newUser->avatar = '';

        if($request->file('avatar')){
            $file = $request->file('avatar')->store('avatars', 'public');
        
            $newUser->avatar = $file;
        }

        $newUser->save();
        
        return redirect()->route('users.index')->with('status', 'User successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        
        return view('users.form', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->name = $request->get('name');
        $user->roles = json_encode($request->get('roles'));
        $user->address = $request->get('address');
        $user->phone = $request->get('phone');
        $user->status = $request->get('status');

        if($request->file('avatar')){
            if($user->avatar && file_exists(storage_path('app/public/' . $user->avatar))){
                \Storage::delete('public/'.$user->avatar);
            }
            $file = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $file;
        }

        $user->save();

        return redirect()->route('users.index')->with('status', 'User succesfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('users.index')->with('status', 'User successfully delete');
    }
}
