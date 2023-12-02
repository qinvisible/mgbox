<?php

namespace App\Http\Controllers;

use App\Repository\RoleRepository;
use Illuminate\Http\Request;

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
        return  $this->RoleRepo->index();
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
        return  response($this->RoleRepo->store($request));
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
    public function edit(string $id, Request $request)
    {
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        return response($this->RoleRepo->update($request, $id),200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->RoleRepo->destroy($id);
    }
}
