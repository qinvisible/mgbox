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
    private $categories;
    public function __construct() {
        $categories = Category::all();
        $this->categories = [];
        foreach ($categories as $cat) {
            array_push($this->categories, [
                'id'    => $cat->id,
                'name'  => $cat->name,
                'desc'  => $cat->desc
            ]);
        }

    }
    public function index($request)
    {
        $cat = $request->all();
        $req = $cat['cat'] ?? null;
        return [
            'data' => $this->getProducts($req)
        ];
    }

    public function getProducts($req, $ids = null) {
        if ($req) {
            $productCat =  ProductCategory::when(['category_id' => $req])->get();
            $products = [];
            foreach ($productCat as $item) {
                if ($item->category_id == $req) {
                    array_push($products,  $item->product_id);
                }
            }
            $ids = $products;
            if ($ids) {
                $products = Product::find($ids);
            }
        }
        else {
            $products = Product::all();
        }
        $productdata = [];
        foreach ($products as  $prod) {
            $cat = null;
            try {
                $cat = Category::findOrFail($prod->productCategory->category_id);
            } catch (\Throwable $th) {
                $cat = null;
            }
            $productdata [] =  [
                'id' => $prod['id'],
                'name' => $prod['name'],
                'desc' => $prod['desc'],
                'price' => $prod['price'],
                'width' => $prod['width'],
                'height' => $prod['height'],
                'length' => $prod['length'],
                'thickness' => $prod['thickness'],
                'location' => $prod['location'],
                'amount'    => $prod['amount'],
                'category' => [
                    'name' => isset($cat['name'])?$cat['name']:null,
                    'desc' => isset($cat['desc'])?$cat['desc']:null
                ]
            ];
            
        }
        return $productdata;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return [
            'product' => [
                'id' => $prod['id'] ?? '',
                'name' => $prod['name'] ?? '',
                'desc' => $prod['desc'] ?? '',
                'price' => $prod['price'] ?? 0,
                'width' => $prod['width'] ?? 0,
                'height' => $prod['height'] ?? 0,
                'length' => $prod['length'] ?? 0,
                'thickness' => $prod['thickness'] ?? 0,
                'location' => $prod['location'] ?? '',
                'amount'    => $prod['amount'] ?? '',
                'category' => [
                    'name' => isset($cat['name']) ? $cat['name'] : null,
                    'desc' => isset($cat['desc']) ? $cat['desc'] : null
                ],
            ]
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($request)
    {
        $product = Product::create([
            "name"          => $request['name'],
            "desc"          => $request['desc'],
            "price"         => $request['price'],
            "width"         => $request['width'],
            "height"        => $request['height'],
            "length"        => $request['length'],
            "thickness"     => $request['thickness'],
            "amount"        => $request['amount'],
            "user_id"       => $request['user_id'],
            "location"      => $request['location'],
            'category_id'   => $request['category_id']
        ]);
        if ($product) {
            ProductCategory::create(['category_id' => $request['category_id'], 'product_id' => $product->id]);
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
        
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        if (!$product) {
            return [
                'status' => 'fail',
                'message' => 'Product tidak ditemukan'
            ];
        } else {
            $cat = Category::find($product->productCategory['category_id']);
            return [
                'status'    => 'success',
                'product'      => [
                    'id' => $product['id'],
                    'name' => $product['name'],
                    'desc' => $product['desc'],
                    'price' => $product['price'],
                    'width' => $product['width'],
                    'location' => $product['location'],
                    'height' => $product['height'],
                    'length' => $product['length'],
                    'amount'    => $product['amount'],
                    'thickness' => $product['thickness'],
                    'category_id' => $cat->id
                        
                ]
            ];
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($request, $id)
    {
        $action = $request['action'] ?? null;
        $product = Product::findOrFail($id);
        if (($action == 'addStock')) {
            $product->amount = $product->amount + $request['amount'];
        } elseif (($action == 'descStock')) {
            if ($request['amount'] > $product->amount) {
                return [
                    'status' => 'fail',
                    'message'=> "Jumlah produk kurang, jumlah product hanya {$product->amount}"
                ];
            }
            $product->amount = $product->amount - $request['amount'];
        }
        else {
            try {
                $product->update($request->only(['name','desc','price','width','height','length','thickness']));
                $this->updateProducuctCat($id, $request['category_id']);
                return [
                    'status' => 'success',
                    'message'=> "Produk {$request['name']} sudah diupdate."
                ];
            } catch (\Throwable $th) {
                return [
                    'status' => 'fail',
                    'message'=> "Produk gagal diupdate"
                ];
            }
        }
    }

    private function updateProducuctCat($productID, $categoriID) {
        try {
            $productCat = Product::find($productID)->productCategory();
            $productCat->update(['category_id' => $categoriID]);
        } catch (\Throwable $th) {
            return [
                'status' => 'fail',
                'message' => "Produk gagal diupdate"
            ];
        }
        
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product) {
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