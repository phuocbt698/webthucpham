<?php

namespace App\Models\AdminModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_vendor';
    protected $primaryKey = 'id'; 
    protected $fillable  = [
        'id',
        'name',
        'slug',
        'email',
        'website',
        'path_image',
        'phone',
        'is_active',
        'address',
        'city_id',
        'district_id',
        'ward_id',
        'created_at',
        'updated_at'
    ];
}
