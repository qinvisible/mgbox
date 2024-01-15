<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserRepository
{
    private $roleRepo;
    public function __construct() {
        
        $this->roleRepo = new RoleRepository();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userq  = User::orderBy('created_at', 'desc')->get();
        $data  = [];
        foreach ($userq as $key => $user) {
            $Urole = $user->role;
            $role = [
                'name' => $Urole->name,
                'permission' => explode(',', $Urole->permission)
            ];
            array_push($data, [
                'user' => $user,
                'role' => $role
            ]);
        }
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($request)
    {
        $roles  = $this->roleRepo->index();
        $users  = [];
        return [
            'user' => $users,
            'roles' => $roles
        ];
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
                'data'    => $user,
                'message'   => "User {$user->name} berhasil ditambahkan."
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
        $user = User::with('role')->find($id);
        return [
            'user'=>$user,
            'roles'=> $this->roleRepo->index()
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($request, $id)
    {
        $user = User::find($id);
        $user->update($request->only(['name', 'role_id']));
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user   = User::findOrFail($id);
        $name   = $user->name;
        try {
            $user->destroy($id);
            return [
                'status'  => true,
                'message' => "{$name} telah dihapus."
            ];
        } catch (\Throwable $th) {
            return [
                'status'  => false,
                'message' => $th
            ];
        }

    }
}
