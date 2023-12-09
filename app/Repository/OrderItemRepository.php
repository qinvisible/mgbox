<?php

namespace App\Repository;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Nette\Utils\Arrays;

class OrderItemRepository {
    public function addItem($request, $order_id) {
        $validator  = Validator::make($request->all(), ['target_date' => 'required']);
        if ($validator->fails()) {
            return [
                'status' => 'fail',
                'message'=> $validator->messages()
            ];
        }
        $product    = Product::findOrFail($request['product_id']);
        $order      = Order::findOrFail($order_id);
        $productReady  = OrderItem::findOrFail(['product_id' => $request['product_id']])->first();
        $dataToSave = [
            'product_id'        => $request['product_id'],
            'order_id'          => $order_id,
            'name'              => $product['name'],
            'price'             => $product['price'],
            'width'             => $product['width'],
            'height'            => $product['height'],
            'length'            => $product['length'],
            'thickness'         => $product['thickness'],
            'item_number'       => $request['item_number'],
            'item_done'         => $request['item_done'],
            'item_remaining'    => $request['item_remaining'],
            'target_date'       => $request['target_date'],
        ];
        $message = "ditambahkan";
        if ($productReady) {
            $message = "diperbaharui";
            $productReady->update($dataToSave);
        } else {
            OrderItem::create($dataToSave);
        }
    
        $order->update([
            'total_payment' => ($order['total_payment'] + ( $product['price'] * $request['item_number'])),
            'remaining_payment' => $order['total_payment'] - $order['paid']
        ]);
        
        return [
            'status'  => 'success',
            'message' => "Product {$product['name']} dengan kuantitas {$request['item_number']} telah {$message}."
        ];
    }
    public function deleteItem($ids) {
        return OrderItem::destroy($ids);
    }
    public function getOrderItem($order) {
        $items = $order->order_items;
        try {
            return array_map(function($item){
                return [
                    "name" =>  $item["name"],
                    "price" =>  $item["price"],
                    "width" =>  $item["width"],
                    "height" =>  $item["height"],
                    "length" =>  $item["length"],
                    "thickness" =>  $item["thickness"],
                    "item_number" =>  $item["item_number"],
                    "item_done" =>  $item["item_done"],
                    "item_remaining" =>  $item["item_remaining"],
                    "target_date" =>  $item["target_date"],
                ];
            }, $items->toArray());
            
        } catch (\Throwable $th) {
            return $th;
        }
    }

}
