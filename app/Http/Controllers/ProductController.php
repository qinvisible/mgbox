<?php

namespace App\Http\Controllers;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class ProductController extends Controller
{
    private $productRepo;
    private $categoryRepo;
    public function __construct() {
        $this->productRepo = new ProductRepository();
        $this->categoryRepo = new CategoryRepository();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->productRepo->index();
        return Inertia::render('Product/Index', [
            'products' => $products['data']
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        Inertia::share('flash', session('flash', false));
        $product = $this->productRepo->create($request);
        return Inertia::render('Product/Form', [
            'product'  => $product,
            'categories' => $this->categoryRepo->index()['data']
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
                "name"          =>  "required",
                "desc"          =>  "required",
                "price"         =>  "required|numeric",
                "width"         =>  "required|numeric",
                "height"        =>  "required|numeric",
                "length"        =>  "required|numeric",
                "thickness"     =>  "required|numeric",
                "amount"        =>  "required|numeric",
                "location"      =>  "required",
                'category_id'   =>  "required"
                ]
            );
            if ($validator->fails()) {
                return redirect(route('product.create'))->withErrors($validator->messages())->withInput();
            } else {
                $product = $this->productRepo->store($request);
                return redirect(route('product.index'))->withFlash($product['message']);
            }
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
        Inertia::share('flash', session('flash', false));
        $product = $this->productRepo->edit($id);
        return Inertia::render('Product/Form', [
            'product' => $product['product'],
            'categories' => $this->categoryRepo->index()['data']
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                "name"          =>  "required",
                "desc"          =>  "required",
                "price"         =>  "required|numeric",
                "width"         =>  "required|numeric",
                "height"        =>  "required|numeric",
                "length"        =>  "required|numeric",
                "thickness"     =>  "required|numeric",
                "amount"        =>  "required|numeric",
                "location"      =>  "required",
                'category_id'   =>  "required"
            ]
        );
        if ($validator->fails()) {
            return redirect(route('product.edit'))->withErrors($validator->messages())->withInput();
        } else {
            $update = $this->productRepo->update($request, $id);
            return redirect(route('product.edit', $id))->withFlash($update['message']);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $destroy = $this->productRepo->destroy($id);
        if ($destroy['status'] == 'success') {
            return redirect(route('product.index'))->withFlash($destroy['message']);
        }
    }
    public function addCategory(Request $request) {
        return $this->productRepo->addCategory(($request));
    }
}
