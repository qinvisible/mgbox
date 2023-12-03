<?php

namespace App\Http\Controllers;

use App\Repository\CustomerRepository;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private $customerRepo;
    public function __construct() {
        $this->customerRepo = new CustomerRepository();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response($this->customerRepo->index());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return response($this->customerRepo->store($request));
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
    public function update(Request $request, string $id)
    {
        return response($this->customerRepo->update($request, $id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
