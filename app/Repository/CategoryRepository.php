<?php

namespace App\Repository;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function PHPSTORM_META\map;

class CategoryRepository
{
    protected $table = 'categories';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $categoriesData = [];
        foreach ($categories as $cat) {
            $ids = array_map(function($i) {
                return $i['product_id'];
            },$cat->products->toArray());
            try {
                $products = Product::whereIn('id', $ids)->get();
            } catch (\Throwable $th) {
                return $th;
            }
            $products = array_map(function($product){
                return [
                    "name" => $product["name"],
                    "desc" => $product["desc"],
                    "price" => $product["price"],
                    "width" => $product["width"],
                    "height" => $product["height"],
                    "length" => $product["length"],
                    "thickness" => $product["thickness"],
                    "location" => $product["location"],
                    "amount" => $product["amount"],
                ];
            }, $products->toArray());
            $categoriesData[] = [
                [
                    'name' => $cat['name'],
                    'desc' => $cat['desc'],
                    'id'   => $cat['id'],
                    'products' => $products
                ]
                ];
        }
       
        return [
            'data' => $categoriesData
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
        $validators = Validator::make($request->all(), 
        [
            'name'          => 'required|unique:categories,name',
            'desc'          => 'required'
        ]);
      
        if ($validators->fails()) 
        {
            return [
                'status' => 'fail',
                'message'=> $validators->messages()
            ];
        } 
        else 
        {
            $category = Category::create([
                'name' => $request['name'],
                'desc' => $request['desc']
            ]);
           
            if ($category) 
            {
                return [
                    'status'    => 'success',
                    'messsage'  => "Kategori {$category->name} berhasil di tambahkan",
                    'data'      => $category
                ];
            }
            else 
            {
                return [
                    'status'    => 'fail',
                    'messsage'  => "Gagal menambahkan kategori"
                ];
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $category   = Category::with('products')->find($id);
            $productIds    = array_map(function($cat){
                return $cat['product_id'];
            }, $category->products->toArray());
            $productRepo = new ProductRepository();
            $products = $productRepo->getProducts($productIds);
            return [
                'status' => 'success',
                'data'  => [
                    'name'  => $category['name'],
                    'desc'  => $category['desc'],
                    'id'    => $category['id'],
                    'products'  => $products
                ]
            ];
        } catch (\Throwable $th) {
            return $th;
            return [
                'status' => 'fail',
                'message'=> 'Kategori produk tidak ditemukan'
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
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->update($request->toArray());
            return [
                'status'    =>'success',
                'message'   => "{$category->name} berhasil di update."
            ];
        } else {
            return [
                'status'    =>'fail',
                'message'   => "Gagal update kategory produk."
            ];
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if ($category) {
            $name = $category->name;
            $category->destroy($id);
            return [
                'status' => 'success',
                'message'=> "Kategory produk {$name} telah di hapus"
            ];
        }
        else 
        {
            return [
                'status' => 'fail',
                'message'=> "Gagal menghspus kategori produk"
            ];
        }
    }

}
