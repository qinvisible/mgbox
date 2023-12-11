<?php

namespace App\Http\Controllers;

use App\Repository\UserRepository;
use Illuminate\Http\Request;

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
        return $this->userRepo->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->userRepo->store($request);
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
        return $this->userRepo->destroy($id);
    }
}
