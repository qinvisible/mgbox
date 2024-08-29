<?php

namespace App\Http\Controllers;

use App\Repository\CustomerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

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
        Inertia::share('flash', session('flash', false));
        return  Inertia::render('Customer/Index', [
            'customers' => $this->customerRepo->index()['data']
        ]);
    
    }

    /**
     * View Form create function
     *
     * @param Request $request
     * @return void
     */
    public function create(Request $request)
    {
        Inertia::share('flash', session('flash', false));
        $customer = $this->customerRepo->create($request);
        return Inertia::render('Customer/Form', [
            'customer' => $customer
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
                'address'   => 'required',
                'phone'     => 'required',
                'email'     => 'email'
            ]
        );
        if ($validator->fails()) {
            return redirect(route('customer.create'))->withErrors($validator->messages())->withInput();
        }
        else {
            $customer = $this->customerRepo->store($request);
            return redirect(route('category.index'))->withFlash($customer['message']);
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
        Inertia::share('flash', session('flash', false));
        $customer = $this->customerRepo->edit($id);
        return Inertia::render('Customer/Form', [
            'customer' => $customer
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name'      => 'required',
                'address'   => 'required',
                'phone'     => 'required',
                'email'     => 'email'
            ]
            );
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages())->withInput();
        }
        $customer = $this->customerRepo->update($request, $id);
        return redirect(route('customer.edit', ['id' => $id]))->withFlash($customer['message'])->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer  = $this->customerRepo->destroy($id);
        return  redirect(route('customer.index'))->withFlash($customer['message']);
    }
}
