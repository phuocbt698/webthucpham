<?php

namespace App\Models\AdminModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_user';
    protected $primaryKey = 'id'; 
    protected $fillable  = [
        'id',
        'name',
        'role_id',
        'email',
        'password',
        'path_img',
        'phone',
        'address',
        'city_id',
        'district_id',
        'ward_id',
        'created_at',
        'updated_at'
    ];
}
