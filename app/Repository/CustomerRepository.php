<?php

namespace App\Repository;

use App\Models\Customer;
use Illuminate\Support\Facades\Validator;

class CustomerRepository {
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        $data =   array_map(function($customer){
            return [
                'name'  => $customer['name'] ,
                'address'   => $customer['address'] ,
                'phone'     => $customer['phone'] ,
                'email'     => $customer['email'] ,
            ];

        }, $customers-> toArray());
        return[
            'data' => $data
        ];
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
        $validator = Validator::make($request->all(),[
            'name'      => 'required',
            'address'   => 'required',
            'phone'     => 'required',
            'email'     => 'email'
        ]);
        if ($validator->fails()) {
            return [
                'status' => 'fail',
                'message'=> $validator->messages()
            ];
        } else {
            $customer = Customer::create($request->all());
            if ($customer) {
                return [
                    'status' => 'success',
                    'message'=> "Customer {$customer->name} telah ditambahkan" 
                ];
            } else {
                return [
                    'status' => 'fail',
                    'message'=> 'Gagal menambah customer baru'
                ];
            }
            
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
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($request, $id)
    {
        $customer = Customer::findOrFail($id);
        if (!$customer) {
            return [
                'status' => 'fail'
            ];
        } else {
            $validator = Validator::make($request->all(),[
                'name'      => 'required',
                'address'   => 'required',
                'phone'     => 'required',
                'email'     => 'email'
            ]);
            if ($validator->fails()) {
                return [
                    'status' => 'fail',
                    'message'=> $validator->messages()
                ];
            } else {
                $customer->update($request->toArray());
                return [
                    'status' => 'success',
                    'message'=> "Customer data {$customer['name']} berhasil di update"
                ];
            }
            
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}