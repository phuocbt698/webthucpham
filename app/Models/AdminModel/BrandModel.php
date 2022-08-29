<?php

namespace App\Models\AdminModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_brand';
    protected $primaryKey = 'id'; 
    protected $fillable  = [
        'id',
        'name',
        'slug',
        'path_image',
        'website',
        'is_active',
        'created_at',
        'updated_at'
    ];
}
