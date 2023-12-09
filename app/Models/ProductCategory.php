<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Thiagoprz\CompositeKey\HasCompositeKey;

class ProductCategory extends Model
{
    use HasFactory;
    protected $primaryKey = ['product_id', 'category_id'];
    protected $table = 'product_categories';
    public $incrementing = false;
    protected $fillable = ['product_id', 'category_id'];
    public function productsItem() {
        return $this->belongsToMany(Product::class, 'product_id');
    }
    public function productCategory() {
        return $this->belongsTo(Category::class, 'category_id');
    }
  
    
}
