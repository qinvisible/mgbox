<?php

namespace  App\Repository;

use App\Models\Role;
use Illuminate\Support\Facades\Validator;

class RoleRepository {
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
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
            'name'         => 'required|unique:roles,name',
            'permission'   => 'required',
        ]);
        if ($validators->fails()) {
            return [
                'status'   => 'fail',
                'message'   => $validators->messages()
            ];
        } 
        else {

            $role = Role::create(
                [
                    'name'          => $request['name'],
                    'permission'    => $request['permission']
                ]
            );
            if ($role) {
                return [
                    'status'    => 'success',
                    'message'   => "{$role->name} telah ditambahkan."
                ];
            } else {
                return [
                    'sucess' => 'fail',
                    'message'=> "Gagal menambah role baru."
                ];
            }
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        
        $role = Role::find($id);
        return [
            'name' => $role->name,
            'permission' => explode(',', $role->permission)
        ];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, $request)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($request, $id)
    {
        if (!$request) {
            return [
                'status'    => 'fail',
                'message'   => "Tidak ada perubanan."
            ];
        }
        $role = Role::findOrFail($id);
        if ($role) {    
            $role->update($request->toArray());
            $role->save();
            return [
                'status'    => 'success',
                'Message'   => "Role {$role->name} diperbaharui"
            ];
        }
        else {
            return [
                'status'    => 'fail',
                'message'   => "Tidak ada role"
            ];
        }
        
    }
    public function destroy(string $id)
    {
        $role   = Role::findOrFail($id);
        $name   = '';
        if ($role) {
            $name   = $role->name;
            try {
                $role->destroy();
                return [
                    'status'    => 'success',
                    'message'   => "Role {$name} telah dihapus."
                ];
            } catch (\Throwable $th) {
                return [
                    'message' => "Gagal menghapus {$name} aksess, ada pengguna yang menggunakan akses ini.",
                    'status'    => 'fail',
                ];
            }
        }
        else {
            return [
                'status'    => 'fail',
                'message'   => "Role tidak ada."
            ];
        }
    }

}