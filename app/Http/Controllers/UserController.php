<?php

namespace App\Http\Controllers;

use App\Repository\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class UserController extends Controller
{
    private $userRepo;
    /**
     * Display a listing of the resource.
     */
    public function __construct() {
        $this->userRepo = new UserRepository();
    }
    public function index()
    {
        $users = $this->userRepo->index();
        return Inertia::render('User/Index', [
            'user' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Inertia::share('flash', session('flash', false));
        $data = $this->userRepo->create($request);
        return Inertia::render('User/Form', [
            'user'  => $data['user'],
            'roles'  => $data['roles']
        ]);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name'      => 'required',
                'email'     => 'required|unique:users,email',
                'role_id'   => 'required',
                'password'  => 'required'
            ]
        );
        if ($validator->fails()) {
            return [
                'status'   => 'fail',
                'message'   => $validator->messages()
            ];
            if ($validator->fails()) {
                return redirect(route('uz.create'))->withErrors($validator->messages())->withInput();
            }
        }
        $data  = $this->userRepo->store($request);
       
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        return $this->userRepo->update($request, $id);
    }

    public function updateRole(Request $request, int $id) {
        return $this->userRepo->updateRole($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
