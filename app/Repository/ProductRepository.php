<?php 

namespace App\Repository;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Validator;

class ProductRepository {
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        foreach ($products as $key => $prod) {
            $cat = Category::find($prod->productCategory['category_id']);
            return [
                'name' => $prod['name'],
                'description' => $prod['description'],
                'price' => $prod['price'],
                'width' => $prod['width'],
                'height' => $prod['height'],
                'length' => $prod['length'],
                'thickness' => $prod['thickness'],
                'location' => $prod['location'],
                'category' => [
                    'name' => $cat['name'],
                    'desc' => $cat['desc']
                ]
            ];
        }
        
        return [
            'data' => $products
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
        $validator = Validator::make($request->all(),
            [
                "name"          =>  "required",
                "description"   =>  "required",
                "price"         =>  "required|numeric",
                "width"         =>  "required|numeric",
                "height"        =>  "required|numeric",
                "length"        =>  "required|numeric",
                "thickness"     =>  "required|numeric",
                "location"      =>  "required",
            ]
        );
        if ($validator->fails()) {
            return [
                'status' => 'fails',
                'message'=> $validator->messages()
            ];
        } else {
            try {
                $product = Product::create([
                    "name"          => $request['name'],
                    "description"   => $request['description'],
                    "price"         => $request['price'],
                    "width"         => $request['width'],
                    "height"        => $request['height'],
                    "length"        => $request['length'],
                    "thickness"     => $request['thickness'],
                    "user_id"       => $request['user_id'],
                    "location"      => $request['location']
                ]);
            } catch (\Throwable $th) {
                return $th;
            }
            if ( $product ) {
                return [
                    'status' => 'success',
                    'message'=> "Berhasil produk {$product->name} telah di tambahkan"
                ];
            } else {
                [
                    'status' => 'fail',
                    'message'=> 'Gagal menambahkan product'
                ];
            }
            
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        if (!$product) {
            return [
                'status' => 'fail',
                'message'=> 'Product tidak ditemukan'
            ];
        } else {
            $cat = Category::find($product->productCategory['category_id']);
            return [
                'status'    => 'success',
                'data'      => [
                    'name' => $product['name'],
                    'description' => $product['description'],
                    'price' => $product['price'],
                    'width' => $product['width'],
                    'height' => $product['height'],
                    'length' => $product['length'],
                    'thickness' => $product['thickness'], 
                    'category' => [
                        'name' => $cat['name'],
                        'desc' => $cat['desc']
                    ]
                ]
            ];
        }
        
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
    public function update($request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product) {
            ;
            $name = $product->name;
            $product->destroy($id);
            return [
                'status' => 'successs',
                'message'=> "Product {$name} telah dihapus"
            ];
        } else {
            return [
                'status' => 'fail',
                'message'=> 'Produck tidak ada'
            ];
        }
        
    }
    public function addCategory($request) {
        try {
            $productCat = ProductCategory::create($request->all());
            return $productCat;
        } catch (\Throwable $th) {
            return $th;
        }
    }
}