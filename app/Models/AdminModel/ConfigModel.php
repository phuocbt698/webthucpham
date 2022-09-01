<?php

namespace App\Models\AdminModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_configweb';
    protected $primaryKey = 'id'; 
    protected $fillable  = [
        'id',
        'logo',
        'address',
        'city_id',
        'district_id',
        'ward_id',
        'phone',
        'email',
        'facebook',
        'git',
        'created_at',
        'updated_at'
    ];
}
