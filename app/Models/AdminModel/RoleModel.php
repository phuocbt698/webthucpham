<?php

namespace App\Models\AdminModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_role';
    protected $primaryKey = 'id'; 
    protected $fillable  = [
        'id',
        'name',
        'created_at',
        'updated_at'
    ];
}
