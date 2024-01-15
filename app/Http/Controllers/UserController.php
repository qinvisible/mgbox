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
        Inertia::share('flash', session('flash', false));
        $users = $this->userRepo->index();
        return Inertia::render('User/Index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        Inertia::share('flash', session('flash', false));
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
                'password'  => 'min:6',
                'password_confirmation' => 'required_with:password|same:password|min:6'
                                
            ]
        );
        if ($validator->fails()) {
            return redirect(route('user.create'))->withErrors($validator->messages())->withInput();
        }
        $user = $this->userRepo->store($request);
        return redirect(route('user.index'))->withFlash('User Baru berhasil di tambahkan');
       
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
        Inertia::share('flash', session('flash', false));
        $data = $this->userRepo->edit($id);
        return Inertia::render('User/Form', [
            'user'  => $data['user'],
            'roles'  => $data['roles']
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $user = $this->userRepo->update($request, $id);
        return redirect(route('user.edit', ['id' => $id]))->withFlash('User data berhasil di update')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = $this->userRepo->destroy($id);
        if ($user['status']) {
            return redirect(route('user.index'))->withFlash($user['message']);
        } else {
            return redirect()->back()->withErrors(['errors' => $user['message']]);
            
        }
        
    }
}
