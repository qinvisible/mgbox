<?php

namespace App\Http\Controllers;

use App\Repository\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ProductController extends Controller
{
    private $productRepo;
    public function __construct() {
        $this->productRepo = new ProductRepository();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response($this->productRepo->index());
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
        $product = $this->productRepo->store($request);
        return response($product);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response($this->productRepo->show($id));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        return response($this->productRepo->destroy($id));
    }
    public function addCategory(Request $request) {
        return $this->productRepo->addCategory(($request));
    }
}
