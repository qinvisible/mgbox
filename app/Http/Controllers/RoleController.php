<?php

namespace App\Http\Controllers;

use App\Repository\RoleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class RoleController extends Controller
{
    private $RoleRepo;
    public function __construct() {
        $this->RoleRepo = new RoleRepository();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return  Inertia::render('Role/Index', [
            'roles' => $this->RoleRepo->index()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        Inertia::share('flash', session('flash', false));
        $data = $this->RoleRepo->create($request);
        return Inertia::render('Role/Form', [
            'role'              => $data['role'],
            'permission_data'   => $data['permission_data'],
            
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator ::make(
            $request->all(),
            [
                'name'         => 'required|unique:roles,name',
                'permission'   => 'required',
            ]
        );
        if ($validator->fails()) {
            return redirect(route('role.create'))->withErrors($validator->messages())->withInput();
        }
        $role =$this->RoleRepo->store($request);
        return redirect(route('role.index'))->withFlash($role['message']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->RoleRepo->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {   
        $data = $this->RoleRepo->edit($id);
        Inertia::share('flash', session('flash', false));
        return Inertia::render('Role/Form', [
            'role'              => $data['role'],
            'permission_data'   => $data['permission_data'],
        ]);
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name'         => 'required',
                'permission'   => 'required',
                
            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages())->withInput();
        }
        $role = $this->RoleRepo->update($request, $id);
        return redirect(route('role.edit',['id'=> $id]))->withFlash($role['message'])->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->RoleRepo->destroy($id);
    }
}
