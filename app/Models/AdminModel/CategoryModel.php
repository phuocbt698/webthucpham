<?php

namespace App\Models\AdminModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_category';
    protected $primaryKey = 'id'; 
    protected $fillable  = [
        'id',
        'name',
        'slug',
        'parent_id',
        'is_active',
        'created_at',
        'updated_at'
    ];

    public function parentCategory(){
        return $this->belongsTo(CategoryModel::class, 'parent_id', 'id');
    }

}
