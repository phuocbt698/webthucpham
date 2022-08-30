<?php

namespace App\Models\AdminModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_product';
    protected $primaryKey = 'id'; 
    protected $fillable  = [
        'id',
        'name',
        'slug',
        'stock',
        'price',
        'path_image',
        'is_hot',
        'is_active',
        'description',
        'category_id',
        'brand_id',
        'vendor_id',
        'user_id',
        'created_at',
        'updated_at'
    ];

    public function category(){
        return $this->hasOne(CategoryModel::class, 'id', 'category_id');
    }
    public function brand(){
        return $this->hasOne(BrandModel::class, 'id', 'brand_id');
    }
    public function vendor(){
        return $this->hasOne(VendorModel::class, 'id', 'vendor_id');
    }
    public function author(){
        return $this->hasOne(UserModel::class, 'id', 'user_id');
    }
}
