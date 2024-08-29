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
                'id'  =>   $customer['id'] ,
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
    public function create($request)
    {

        return [
            'name' => $request['name'] ?? '',
            'address' => $request['address'] ?? '',
            'email' => $request['email'] ?? '',
            'phone' => $request['phone'] ?? '',
        ];
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($request)
    {
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
        $customer = Customer::findOrFail($id);
        return [
            'id'        => $customer->id,
            'name'      => $customer->name,
            'address'   => $customer->address,
            'email'     => $customer->email,
            'phone'     => $customer->phone,
        ];

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
            $customer->update($request->toArray());
            if ($customer) {
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
        $customer = Customer::findOrFail($id);
        if ($customer)
        {
            $name = $customer->name;
            $customer->destroy($id);
            return [
                'status'    => 'success',
                'message'   => "Kustomer dengan nama {$name} telah di hapus"
            ];
        } else {
            return [
                'status' => 'fail',
                'message' => "Gagal menghapus Kostumer"
            ];
        }

    }
}