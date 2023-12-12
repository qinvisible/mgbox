<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserRepository
{
    public function __construct() {
        
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userq = User::all();
        $users = [];
        foreach ($userq as $key => $user) {
            $Urole = $user->role;
            $role = [
                'name' => $Urole->name,
                'permission' => explode(',', $Urole->permission)
            ];
            array_push($users, [
                'name' => $user->name,
                'role' => $role
            ]);
        }
        return $users;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($request)
    {   
        $validators = Validator::make($request->all(),
        [
            'name'      => 'required',
            'email'     => 'required|unique:users,email',
            'role_id'   => 'required',
            'password'  => 'required'
        ]);
        
        if ($validators->fails()) {
            return [
                'status'   => 'fail',
                'message'   => $validators->messages()
            ];
        }
        else {
            $user = User::create([
                'name'      => $request['name'],
                'email'     => $request['email'],
                'role_id'   => $request['role_id'],
                'password'  => bcrypt($request['password'])
            ]);
            return [
                'status'    => 'success',
                'message'   => "User {$user->name} created."
            ];
        }
        
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($request, $id)
    {
        $user = User::find($id);
        $user->update($request->only(['name']));
        return $user;
    }

    public function updateRole($request, $id) {
        $user = User::find($id);
        if ($user->update($request->only(['role_id']))) {
            return [
                'status'    => 'success',
                'message'   => "updated {$user->name} role to {$user->role->name}"
            ];
        }
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy( $id)
    {
        return User::destroy($id);
    }
}
