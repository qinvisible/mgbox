<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Repository\OrderItemRepository;
use App\Repository\OrderRepository;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $orderRepo;
    private $orderItem;
    public function __construct() {
        $this->orderRepo = new OrderRepository();
        $this->orderItem = new OrderItemRepository();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response($this->orderRepo->index());
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
        return response($this->orderRepo->store($request));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return response($this->orderRepo->destroy($id));
    }

    public function getOrderItems($id) {
        return response($this->orderRepo->getOrderItems($id));
    }
    public function addOrder($id, Request $request) {
        return $this->orderItem->addItem($request, $id);
    }
}
