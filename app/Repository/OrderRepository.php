<?php

namespace App\Repository;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class OrderRepository {

    private $orderItemRepo;

    public function __construct() {
        $this->orderItemRepo = new OrderItemRepository();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();
        $items = [];
        foreach ($orders as $key => $order) {
            $items[] = $order->order_items;
        }
        $orderData = [];
      
        foreach ($orders as $key => $order) {
            $orderData[] = [
                'note' => $order['note'],
                'total_payment' => $order['total_payment'],
                'remaining_payment' => $order['remaining_payment'],
                'paid' => $order['paid'],
                'payment_deadline' => $order['payment_deadline'],
                'customer' => $order->customer,
                'items' => $order->order_items
            ];
        }
        return $orderData;
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
    public function store($request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id'       => 'sometimes|required',
            'note'              => 'sometimes|required',
            'total_payment'     => 'sometimes|required|numeric',
            'remaining_payment' => 'sometimes|required|numeric',
            'paid'              => 'sometimes|required|numeric',
            'payment_deadline ' => 'sometimes|required'
        ]);
        

        if ($validator->fails()) {
            return [
                'status' => 'fail',
                'message'=> $validator->messages()
            ];
        }
            $newOrder = Order::create(
                $request->only(
                    ['customer_id',
                    'note',
                    'total_payment',
                    'remaining_payment',
                    'paid', 
                    'payment_deadline'
                ]));
            if ($newOrder) {
                return $this->orderItemRepo->addItem($request, $newOrder['id']);
            }
        
    }
    public function addOderItems($product_id,  $order_id, $target_date)
    {
        $product    = Product::findOrFail($product_id);
        $order      = Order::findOrFail($order_id);
        if ($product) {
            try {
                OrderItem::create([
                    'order_id'  => $order['id'],
                    'product_id' => $product_id,
                    "name" => $product['name'],
                    "desc" => $product['desc'],
                    "price" => $product['price'],
                    "width" => $product['width'],
                    "height" => $product['height'],
                    "length" => $product['length'],
                    "thickness" => $product['thickness'],
                    'target_date' => $target_date
                ]);
            } catch (\Throwable $th) {
                return $th;
            }
            $order->update(['total_payment' => ($order['total_payment'] + ( $product['price'] * $order['item_number']))]);
            return [
                'status'  => 'success',
                'message' => "Product {$product['name']} dengan kuantitas {$order['item_number']} telah ditambahkan."
            ];
        }
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
    public function update($request, int $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        if ($order) {
            try {
                $ids = array_map(function($item){
                    return $item['id'];
                }, $order->order_items->toArray());
                return  $this->orderItemRepo->deleteItem($ids);
            } catch (\Throwable $th) {
                return $th;
            }
        }
        else {
            return [
                'status' => 'fail',
                'message'=> 'Order data tidak ditemukan'
            ];
        }
    }

    public function getOrderItems($id) {
        $order = Order::findOrFail($id);
        return [
            'data' => [
                'total_payment' => $order['total_payment'],
                'remaining_payment' => $order['remaining_payment'],
                'products' => $this->orderItemRepo->getOrderItem($order)
            ]
        ];
    }
}