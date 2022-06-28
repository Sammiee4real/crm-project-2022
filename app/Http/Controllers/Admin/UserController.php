<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $users = User::query()
            ->when(request()->input('search'), function($query,$searchParam){    
                $query->where('first_name','like',"%{$searchParam}%")
                ->orWhere('last_name','like',"%{$searchParam}%")
                ->orWhere('email','like',"%{$searchParam}%");
            })
            ->paginate(10)
            ->withQueryString()
            ->through(fn($user) =>[
            'id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'role' => $user->role,
            'projects' => Project::where('user_id',$user->id)->get()
        ]);

        return Inertia::render('Users/Index',[
            'users' => $users,
            'total_users' => User::count(),
            'filters' => request()->only(['search'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Users/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UpdateUserRequest $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return Inertia::render('Users/Edit',compact('user'));   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        User::where('id',$user->id)->update($request->validated());
        return redirect()->route('users.index')->with('message','User record was successfully updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete(); 
        return redirect()->route('users.index')->with('message','User record was successfully deleted');

    }
}
