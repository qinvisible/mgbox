<?php

namespace  App\Repository;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\Cast\Object_;
use Request;

class RoleRepository {
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::orderBy('created_at', 'desc')->get();
        $roledata = [];
        if (!empty($roles)) {
            foreach ($roles as $key => $role) {
                array_push($roledata, [
                    'id' => $role->id,
                    'name' => $role->name,
                    'permission' =>  explode(',', $role->permission)
                ]);
            }
        }
        return $roledata;
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($request, $validators = null)
    {
        $name           = $request['name'] ?? '';
        $permission     = $request['permission'] ?? [];
        return [
            'role' => [
                'name' => $name,
                'permission' => $permission
            ],
            'permission_data'   => Role::$PERMISSION_DATA,
            'validators'        => $validators
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($request)
    {
        $newRole = [
            'name' => $request['name'],
            'permission' => implode( ',', $request['permission'])
        ];
        $role = Role::create($newRole);
        return [
            'data' => $role,
            'message' => "{$role->name} behasil di tambahkan."
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        
        $role = Role::find($id);
        return [
            'data' => $role,
            'permission' => explode(', ', $role->permission)
        ];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        
        $role = Role::find($id);
        $roleData = [
            'role'=> [
                'id'    => $role->id, 
                'name'  => $role->name,
                'permission' => explode(',', $role->permission),

            ],
            'permission_data' => Role::$PERMISSION_DATA,
        ];
        return $roleData;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($request, $id)
    {
        $role = Role::findOrFail($id);
        $req        = $request->all();
        $role->name = $req['name'];
        $role->permission = "";
        $role->permission = join(',', $req['permission']);
        $role->save();
        return [
            'status'    => 'success',
            'message'   => "Suksess, User Aksess telah diperbaharui",
            'data'      => [
                'id'    => $role->id, 
                'name'  => $role->name,
                'permission' => explode(',', $role->permission),
                
            ],
            'permission_data' => Role::$PERMISSION_DATA,
        ];
    
        
    }
    public function destroy(string $id)
    {
        $role   = Role::findOrFail($id);
        $user   = User::where('role_id', $role->id)->count();
    
        if ($user) {
            return [
                'status' => false,
                'errors' => 'Gagal menghapus, User Aksess digunakan.'
            ];
        }
        $name   = $role->name;
        try {
            $role->destroy($id);
            return [
                'status' => true,
                'message' => "User Aksess {$name} telah dihapus."
            ];
        } catch (\Throwable $th) {
            return [
                'status' => false,
                'message' => $th
            ];
        }
       
    }

}